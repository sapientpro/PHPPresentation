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
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Reader\ReaderInterface;
use PHPUnit\Framework\TestCase;

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
     * `PowerPoint97::canRead()` asks `OLERead` whether the file is an OLE container, which is a good
     * deal more than the files it can parse, so it claims a `.ppt` it then chokes on. The claim used
     * to end the resolution: no reader after it was asked, and the reader's own failure came out of
     * `load()` in place of the factory's.
     *
     * The fixture is `Sample_00_01.ppt` with the two bytes of `docFileVersion` in its CurrentUserAtom
     * zeroed, which is the earliest point the reader gives up at.
     */
    public function testLoadAsksEveryReaderWhenOneClaimsTheFileAndFails(): void
    {
        $file = PHPPRESENTATION_TESTS_BASE_DIR . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'PPT_InvalidCurrentUserAtom.ppt';

        try {
            IOFactory::load($file);
            self::fail('A file no reader can read has to raise ' . InvalidFileFormatException::class);
        } catch (InvalidFileFormatException $exception) {
            self::assertSame(sprintf(
                'The file %s is not in the format supported by class %s (Could not automatically determine the good %s)',
                $file,
                IOFactory::class,
                ReaderInterface::class
            ), $exception->getMessage());

            $previous = $exception->getPrevious();
            self::assertInstanceOf(InvalidFileFormatException::class, $previous);
            self::assertStringContainsString('Location : CurrentUserAtom > docFileVersion', $previous->getMessage());
        }
    }
}
