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

namespace PhpOffice\PhpPresentation\Tests;

use PhpOffice\PhpPresentation\Exception\InvalidClassException;
use PhpOffice\PhpPresentation\Exception\InvalidFileFormatException;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Reader\ReaderInterface;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Tests\Reader\ClaimingReader;
use PhpOffice\PhpPresentation\Tests\Writer\ExternalWriter;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Test class for IOFactory.
 *
 * @coversDefaultClass \PhpOffice\PhpPresentation\IOFactory
 */
class IOFactoryTest extends TestCase
{
    /**
     * Test create writer.
     */
    public function testCreateWriter(): void
    {
        $class = 'PhpOffice\\PhpPresentation\\Writer\\PowerPoint2007';

        self::assertInstanceOf($class, IOFactory::createWriter(new PhpPresentation()));
    }

    /**
     * Test create reader.
     */
    public function testCreateReader(): void
    {
        $class = 'PhpOffice\\PhpPresentation\\Reader\\ReaderInterface';

        self::assertInstanceOf($class, IOFactory::createReader('Serialized'));
    }

    /**
     * Test load class exception.
     */
    public function testLoadClassException(): void
    {
        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage('The class PhpOffice\PhpPresentation\Reader\ is invalid (Reader: The class doesn\'t exist)');
        IOFactory::createReader('');
    }

    public function testLoad(): void
    {
        self::assertInstanceOf('PhpOffice\\PhpPresentation\\PhpPresentation', IOFactory::load(PHPPRESENTATION_TESTS_BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'serialized.phppt'));
    }

    /**
     * Test load class exception.
     */
    public function testLoadException(): void
    {
        $file = PHPPRESENTATION_TESTS_BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'PhpPresentationLogo.png';
        $this->expectException(InvalidFileFormatException::class);
        $this->expectExceptionMessage(sprintf(
            'The file %s is not in the format supported by class PhpOffice\PhpPresentation\IOFactory (Could not automatically determine the good PhpOffice\PhpPresentation\Reader\ReaderInterface)',
            $file
        ));
        IOFactory::load($file);
    }

    /**
     * A name carrying a namespace separator is a class of the caller's own, taken as it is written.
     */
    public function testCreateWriterOutsideTheLibrary(): void
    {
        $writer = IOFactory::createWriter(new PhpPresentation(), ExternalWriter::class);

        self::assertInstanceOf(ExternalWriter::class, $writer);

        $file = tempnam(sys_get_temp_dir(), 'PhpPresentation');
        self::assertIsString($file);
        $writer->save($file);
        self::assertStringEqualsFile($file, ExternalWriter::CONTENT . ', holding 1 slide(s)');
        unlink($file);
    }

    public function testCreateReaderOutsideTheLibrary(): void
    {
        self::assertInstanceOf(ClaimingReader::class, IOFactory::createReader(ClaimingReader::class));
    }

    /**
     * The factory answers with a `ReaderInterface`, so a class that is not one cannot come out of
     * it -- and a name is only ever turned into an object once it has been shown to be one.
     */
    public function testCreateReaderRefusesAClassThatIsNoReader(): void
    {
        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf(
            'The class %s is invalid (Reader: The class does not implement %s)',
            PhpPresentation::class,
            ReaderInterface::class
        ));
        IOFactory::createReader(PhpPresentation::class);
    }

    /**
     * A reader that says it can read the file and then cannot does not end the search.
     * `PowerPoint97::canRead()` answers for any OLE container, which is a good deal more than the
     * files it can parse, so a `.ppt` it chokes on used to stop the resolution where it stood.
     */
    public function testLoadTriesTheNextReaderWhenOneClaimsTheFileAndFails(): void
    {
        $file = PHPPRESENTATION_TESTS_BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'serialized.phppt';

        self::assertInstanceOf(
            PhpPresentation::class,
            IOFactory::load($file, array_merge([ClaimingReader::class], IOFactory::getDefaultReaders()))
        );
    }

    /**
     * When none of them could, the first failure is carried on the exception: it says a great deal
     * more than the fact that the resolution came to nothing.
     */
    public function testLoadCarriesTheFirstFailure(): void
    {
        $file = PHPPRESENTATION_TESTS_BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'PhpPresentationLogo.png';

        try {
            IOFactory::load($file, [ClaimingReader::class]);
            self::fail('An unreadable file has to raise ' . InvalidFileFormatException::class);
        } catch (InvalidFileFormatException $exception) {
            $previous = $exception->getPrevious();
            self::assertInstanceOf(RuntimeException::class, $previous);
            self::assertSame(ClaimingReader::FAILURE, $previous->getMessage());
        }
    }
}
