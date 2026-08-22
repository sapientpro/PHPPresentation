<?php

/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

declare(strict_types=1);

namespace PhpOffice\PhpPresentation\Tests\Opc;

use PhpOffice\Opc\ContentTypes;
use PhpOffice\Opc\Package;
use PhpOffice\Opc\Part;
use PhpOffice\Opc\PartName;
use PhpOffice\Opc\Relationship;
use PHPUnit\Framework\TestCase;

/**
 * The package layer, exercised against a real .pptx the library itself wrote, and against
 * a package built from nothing.
 */
class PackageTest extends TestCase
{
    private const REL_DOCUMENT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';
    private const REL_SLIDE = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/slide';
    private const REL_LAYOUT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/slideLayout';

    /** @var array<int, string> */
    private $written = [];

    protected function tearDown(): void
    {
        foreach ($this->written as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $this->written = [];
    }

    public function testAPackageIsReadWithoutKnowingWhatAPresentationIs(): void
    {
        $package = Package::open(PHPPRESENTATION_TESTS_BASE_DIR . '/resources/files/Sample_00_01.pptx');

        $document = $package->getRelationships()->firstOfType(self::REL_DOCUMENT);
        self::assertNotNull($document);
        self::assertSame('/ppt/presentation.xml', $document->getTargetPartName());

        $presentation = $package->getPart($document->getTargetPartName());
        self::assertNotNull($presentation);
        self::assertSame(
            'application/vnd.openxmlformats-officedocument.presentationml.presentation.main+xml',
            $presentation->getContentType()
        );

        $slides = $package->getRelatedParts('/ppt/presentation.xml', self::REL_SLIDE);
        self::assertNotEmpty($slides);
        self::assertSame('/ppt/slides/slide1.xml', $slides[0]->getName());

        // and a part reached through two relationships is still just a part
        $layout = $package->getRelationships('/ppt/slides/slide1.xml')->firstOfType(self::REL_LAYOUT);
        self::assertNotNull($layout);
        self::assertStringStartsWith('/ppt/slideLayouts/slideLayout', $layout->getTargetPartName());
        self::assertNotNull($package->getPart($layout->getTargetPartName()));

        $package->close();
    }

    public function testEveryPartOfARealPackageHasAContentType(): void
    {
        $package = Package::open(PHPPRESENTATION_TESTS_BASE_DIR . '/resources/files/Sample_00_01.pptx');
        $names = $package->getPartNames();
        self::assertGreaterThan(10, count($names));
        foreach ($names as $name) {
            self::assertNotNull($package->getContentTypes()->typeOf($name), sprintf('"%s" has no content type', $name));
        }
        $package->close();
    }

    public function testAPackageBuiltFromNothingSurvivesTheRoundTrip(): void
    {
        $package = Package::create();
        $main = new Part('/ppt/presentation.xml', 'application/vnd.ms-fake+xml', '<?xml version="1.0"?><root/>');
        $image = new Part('/ppt/media/image1.png', 'image/png', 'not really a png');
        $package->addPart($main);
        $package->addPart($image);
        $package->getRelationships()->relate(self::REL_DOCUMENT, $main->getName());
        $main->getRelationships()->relate(self::REL_SLIDE, $image->getName());

        $file = $this->tempFile();
        $package->save($file);

        $reopened = Package::open($file);
        self::assertSame(['/ppt/media/image1.png', '/ppt/presentation.xml'], $reopened->getPartNames());
        self::assertSame('image/png', (string) $reopened->getContentTypes()->typeOf('/ppt/media/image1.png'));
        $document = $reopened->getRelationships()->firstOfType(self::REL_DOCUMENT);
        self::assertNotNull($document);
        self::assertSame('/ppt/presentation.xml', $document->getTargetPartName());
        $related = $reopened->getRelationships('/ppt/presentation.xml')->firstOfType(self::REL_SLIDE);
        self::assertNotNull($related);
        // written relative to the part that declares it, read back as an absolute name
        self::assertSame('media/image1.png', $related->getTarget());
        self::assertSame('/ppt/media/image1.png', $related->getTargetPartName());
        $reopened->close();
    }

    public function testAnExternalTargetNamesNothingInsideThePackage(): void
    {
        $relationships = (new Part('/ppt/slides/slide1.xml', 'x'))->getRelationships();
        $relationships->relate('hyperlink', 'https://example.org/', 'rId9', Relationship::MODE_EXTERNAL);
        $relationship = $relationships->get('rId9');
        self::assertNotNull($relationship);
        self::assertTrue($relationship->isExternal());
        self::assertSame('https://example.org/', $relationship->getTargetPartName());
        self::assertStringContainsString('TargetMode="External"', $relationships->toXml());
    }

    public function testContentTypesRecordsTheCheapestFormItCan(): void
    {
        $types = new ContentTypes();
        $types->record('/ppt/slides/slide1.xml', 'slide+xml');
        $types->record('/ppt/slides/slide2.xml', 'slide+xml');
        $types->record('/docProps/core.xml', 'core+xml');

        // the first of an extension becomes the default, the one that disagrees an override
        self::assertSame(['xml' => 'slide+xml'], $types->getDefaults());
        self::assertSame(['/docProps/core.xml' => 'core+xml'], $types->getOverrides());
        self::assertSame('slide+xml', $types->typeOf('/ppt/slides/slide2.xml'));
        self::assertSame('core+xml', $types->typeOf('/docProps/core.xml'));
    }

    /**
     * @dataProvider dataProviderPartNames
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('dataProviderPartNames')]
    public function testPartNamesFollowTheSpecification(string $method, string $first, string $second, string $expected): void
    {
        self::assertSame($expected, PartName::$method($first, $second));
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function dataProviderPartNames(): array
    {
        return [
            ['resolve', '/ppt/presentation.xml', 'slides/slide1.xml', '/ppt/slides/slide1.xml'],
            ['resolve', '/ppt/slides/slide1.xml', '../slideLayouts/slideLayout1.xml', '/ppt/slideLayouts/slideLayout1.xml'],
            ['resolve', '/ppt/slides/slide1.xml', '/ppt/media/image1.png', '/ppt/media/image1.png'],
            ['resolve', '/', 'ppt/presentation.xml', '/ppt/presentation.xml'],
            ['relativise', '/ppt/presentation.xml', '/ppt/slides/slide1.xml', 'slides/slide1.xml'],
            ['relativise', '/ppt/slides/slide1.xml', '/ppt/slideLayouts/slideLayout1.xml', '../slideLayouts/slideLayout1.xml'],
            ['relativise', '/', '/ppt/presentation.xml', 'ppt/presentation.xml'],
        ];
    }

    /**
     * @dataProvider dataProviderRelationshipParts
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('dataProviderRelationshipParts')]
    public function testRelationshipsLiveInAPartOfTheirOwn(string $part, string $expected): void
    {
        self::assertSame($expected, PartName::relationshipsFor($part));
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function dataProviderRelationshipParts(): array
    {
        return [
            ['/', '/_rels/.rels'],
            ['/ppt/presentation.xml', '/ppt/_rels/presentation.xml.rels'],
            ['/ppt/slides/slide1.xml', '/ppt/slides/_rels/slide1.xml.rels'],
        ];
    }

    private function tempFile(): string
    {
        $file = (string) tempnam(sys_get_temp_dir(), 'opc');
        $this->written[] = $file;

        return $file;
    }
}
