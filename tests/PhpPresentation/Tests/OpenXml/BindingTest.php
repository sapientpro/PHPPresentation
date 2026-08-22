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

namespace PhpOffice\PhpPresentation\Tests\OpenXml;

use DOMDocument;
use DOMElement;
use DOMText;
use DOMXPath;
use PhpOffice\Opc\Package;
use PhpOffice\OpenXml\Binding\Engine;
use PhpOffice\OpenXml\Codegen\SpecExporter;
use PhpOffice\OpenXml\Codegen\XsdParser;
use PhpOffice\OpenXml\Schema\Schema;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\OpenXml\FontBinding;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Shape\RichText\Run;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Font;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * The claim under test: a reader and a writer can come from one description of the
 * format, and the description can come from the schema rather than from a person.
 *
 * The measure is the writer the library already has. If the generated one emits what the
 * hand-written one emits, for every font the model can express, then the hand-written one
 * is redundant.
 */
class BindingTest extends TestCase
{
    private const NS_DRAWING = 'http://schemas.openxmlformats.org/drawingml/2006/main';

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

    /**
     * @dataProvider dataProviderFonts
     */
    #[DataProvider('dataProviderFonts')]
    public function testTheGeneratedWriterEmitsWhatTheHandWrittenOneEmits(string $case, callable $configure): void
    {
        $run = new Run();
        $configure($run);

        $expected = $this->runPropertiesWrittenByTheLibrary($run);
        $actual = $this->runPropertiesWrittenByTheBinding($run);

        self::assertSame($expected, $actual, sprintf('the two writers disagree on "%s"', $case));
    }

    /**
     * @dataProvider dataProviderFonts
     */
    #[DataProvider('dataProviderFonts')]
    public function testTheSameDescriptionReadsBackWhatItWrote(string $case, callable $configure): void
    {
        $run = new Run();
        $configure($run);

        $engine = new Engine(Schema::drawingMLText(), self::NS_DRAWING, 'a');
        $document = new DOMDocument();
        $element = $engine->write($document, 'rPr', FontBinding::TYPE, FontBinding::fromRun($run));
        $document->appendChild($element);

        $font = FontBinding::toFont($engine->read($element, FontBinding::TYPE));
        $original = $run->getFont();

        self::assertSame($original->isBold(), $font->isBold(), $case);
        self::assertSame($original->isItalic(), $font->isItalic(), $case);
        self::assertSame($original->getSize(), $font->getSize(), $case);
        self::assertSame($original->getName(), $font->getName(), $case);
        self::assertSame($original->getUnderline(), $font->getUnderline(), $case);
        self::assertSame($original->getStrikethrough(), $font->getStrikethrough(), $case);
        self::assertSame($original->getCapitalization(), $font->getCapitalization(), $case);
        self::assertSame($original->getCharacterSpacing(), $font->getCharacterSpacing(), $case);
        self::assertSame($original->getBaseline(), $font->getBaseline(), $case);
        self::assertSame($original->getFormat(), $font->getFormat(), $case);
        self::assertSame($original->getPanose(), $font->getPanose(), $case);
        self::assertSame($original->getPitchFamily(), $font->getPitchFamily(), $case);
        // charset excepted: what comes back is not what went in, and the fault is not
        // the binding's -- see testTheBindingFindsWhatTheHandWrittenPairGetsWrong()
        if (Font::CHARSET_DEFAULT === $original->getCharset()) {
            self::assertSame($original->getCharset(), $font->getCharset(), $case);
        }
        self::assertSame($original->getColor()->getARGB(), $font->getColor()->getARGB(), $case);
    }

    /**
     * @return array<string, array{0: string, 1: callable}>
     */
    public static function dataProviderFonts(): array
    {
        return [
            'a font left alone' => ['a font left alone', static function (Run $run): void {
                $run->setText('x');
            }],
            'bold and italic' => ['bold and italic', static function (Run $run): void {
                $run->getFont()->setBold(true)->setItalic(true);
            }],
            'a size and a colour' => ['a size and a colour', static function (Run $run): void {
                $run->getFont()->setSize(24)->setColor(new Color('FFAABBCC'));
            }],
            'a translucent colour' => ['a translucent colour', static function (Run $run): void {
                $run->getFont()->setColor(new Color('80FF0000'));
            }],
            'underlined and struck through' => ['underlined and struck through', static function (Run $run): void {
                $run->getFont()->setUnderline(Font::UNDERLINE_DOUBLE)->setStrikethrough(Font::STRIKE_DOUBLE);
            }],
            'small capitals, spaced out and raised' => ['small capitals, spaced out and raised', static function (Run $run): void {
                $run->getFont()->setCapitalization(Font::CAPITALIZATION_SMALL)->setCharacterSpacing(120)->setBaseline(30000);
            }],
            'an east asian face' => ['an east asian face', static function (Run $run): void {
                $run->getFont()->setName('MS Mincho')->setFormat(Font::FORMAT_EAST_ASIAN);
            }],
            'a complex script face with a panose and a charset' => ['a complex script face with a panose and a charset', static function (Run $run): void {
                $run->getFont()->setName('Arial')->setFormat(Font::FORMAT_COMPLEX_SCRIPT)
                    ->setPanose('020B0604020202020204')->setPitchFamily(34)->setCharset(18);
            }],
            'another language' => ['another language', static function (Run $run): void {
                $run->setLanguage('uk-UA');
            }],
        ];
    }

    /**
     * What the pilot was for. Reading the schema instead of a person turns a disagreement
     * between a writer, a reader and the specification into a failing assertion.
     *
     * `CT_TextFont@charset` is an `xsd:byte`. The writer spells it in hexadecimal
     * (`AbstractSlide::writeRunStyles()`), the reader reads it as decimal
     * (`PowerPoint2007::loadParagraph()`), and the schema allows only the decimal form.
     * A charset of 18 is therefore written as "12", read back as 12, and no test
     * complains -- `PptSlidesTest::testRichTextRunFontCharset()` asserts the "12".
     */
    public function testTheBindingFindsWhatTheHandWrittenPairGetsWrong(): void
    {
        $run = new Run();
        $run->getFont()->setCharset(18);

        $engine = new Engine(Schema::drawingMLText(), self::NS_DRAWING, 'a');
        $document = new DOMDocument();
        $element = $engine->write($document, 'rPr', FontBinding::TYPE, FontBinding::fromRun($run));
        $document->appendChild($element);

        // what the library writes, mirrored by the binding so that the two stay comparable
        self::assertSame('12', $element->getElementsByTagNameNS(self::NS_DRAWING, 'latin')->item(0)->getAttribute('charset'));

        // and what the schema says that string means
        self::assertSame('int', Schema::drawingMLText()->type('CT_TextFont')['attributes']['charset']['type']);
        self::assertSame(18, FontBinding::toFont(['cs' => ['@charset' => 18]])->getCharset());
        self::assertSame(12, FontBinding::toFont($engine->read($element, FontBinding::TYPE))->getCharset());
    }

    public function testTheCheckedInDescriptionIsWhatTheSchemaSaysToday(): void
    {
        $xsd = PHPPRESENTATION_TESTS_BASE_DIR . '/resources/schema/ecma-376/dml-main.xsd';
        $parser = new XsdParser($xsd);
        $generated = SpecExporter::toPhp(
            $parser->specify(['CT_TextCharacterProperties', 'CT_TextParagraphProperties'], 3),
            'tests/resources/schema/ecma-376/dml-main.xsd',
            'CT_TextCharacterProperties, CT_TextParagraphProperties'
        );

        self::assertSame(
            $generated,
            (string) file_get_contents(__DIR__ . '/../../../../src/OpenXml/Schema/Generated/DrawingMLText.php'),
            'the checked-in description no longer matches the schema it was generated from'
        );
    }

    public function testTheDescriptionCarriesWhatTheSchemaDeclares(): void
    {
        $type = Schema::drawingMLText()->type(FontBinding::TYPE);

        self::assertCount(19, $type['attributes'], 'a:rPr allows 19 attributes');
        self::assertSame('bool', $type['attributes']['b']['type']);
        self::assertCount(18, $type['attributes']['u']['values'], 'the schema names 18 kinds of underline');
        self::assertSame(
            ['ln', 'noFill', 'solidFill', 'gradFill', 'blipFill', 'pattFill', 'grpFill', 'effectLst', 'effectDag',
                'highlight', 'uLnTx', 'uLn', 'uFillTx', 'uFill', 'latin', 'ea', 'cs', 'sym', 'hlinkClick',
                'hlinkMouseOver', 'extLst'],
            array_column($type['children'], 'name'),
            'and the order a valid file must spell them in'
        );
    }

    /**
     * The library's own writer, read back out of the package it wrote.
     */
    private function runPropertiesWrittenByTheLibrary(Run $run): string
    {
        $presentation = new PhpPresentation();
        $shape = $presentation->getActiveSlide()->createRichTextShape();
        $paragraph = $shape->getActiveParagraph();
        $paragraph->setRichTextElements([$run]);

        $file = (string) tempnam(sys_get_temp_dir(), 'bind') . '.pptx';
        $this->written[] = $file;
        IOFactory::createWriter($presentation, 'PowerPoint2007')->save($file);

        $package = Package::open($file);
        $slide = $package->getPart('/ppt/slides/slide1.xml');
        self::assertNotNull($slide);
        $document = $slide->getDocument();
        $package->close();

        $xpath = new DOMXPath($document);
        $xpath->registerNamespace('a', self::NS_DRAWING);
        $node = $xpath->query('//a:r/a:rPr')->item(0);
        self::assertInstanceOf(DOMElement::class, $node);

        return self::canonical($node);
    }

    private function runPropertiesWrittenByTheBinding(Run $run): string
    {
        $engine = new Engine(Schema::drawingMLText(), self::NS_DRAWING, 'a');
        $document = new DOMDocument();
        $element = $engine->write($document, 'rPr', FontBinding::TYPE, FontBinding::fromRun($run));
        $document->appendChild($element);

        return self::canonical($element);
    }

    /**
     * The library's writer indents what it writes and the binding does not, which is a
     * difference in nothing: the whitespace between elements carries no meaning here.
     */
    private static function canonical(DOMElement $element): string
    {
        $element = clone $element;
        $stack = [$element];
        while ($stack) {
            $node = array_pop($stack);
            foreach (iterator_to_array($node->childNodes) as $child) {
                if ($child instanceof DOMText && '' === trim($child->textContent)) {
                    $node->removeChild($child);

                    continue;
                }
                if ($child instanceof DOMElement) {
                    $stack[] = $child;
                }
            }
        }

        return (string) $element->C14N(true);
    }
}
