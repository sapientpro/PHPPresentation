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

namespace PhpOffice\PhpPresentation;

use PhpOffice\PhpPresentation\Exception\InvalidClassException;
use PhpOffice\PhpPresentation\Exception\InvalidFileFormatException;
use PhpOffice\PhpPresentation\Reader\ReaderInterface;
use PhpOffice\PhpPresentation\Writer\WriterInterface;
use ReflectionClass;
use Throwable;

/**
 * IOFactory.
 */
class IOFactory
{
    /**
     * Autoresolve classes.
     *
     * @var array<int, string>
     */
    private static $autoResolveClasses = ['Serialized', 'ODPresentation', 'PowerPoint97', 'PowerPoint2007'];

    /**
     * Create writer.
     */
    public static function createWriter(PhpPresentation $phpPresentation, string $name = 'PowerPoint2007'): WriterInterface
    {
        return self::loadClass('PhpOffice\\PhpPresentation\\Writer\\' . $name, 'Writer', $phpPresentation);
    }

    /**
     * Create reader.
     */
    public static function createReader(string $name): ReaderInterface
    {
        return self::loadClass('PhpOffice\\PhpPresentation\\Reader\\' . $name, 'Reader');
    }

    /**
     * Loads PhpPresentation from file using automatic ReaderInterface resolution.
     *
     * A reader that says it can read the file and then cannot does not end the search: the next one
     * is asked, and only when none of them has produced a presentation is the failure raised.
     * `PowerPoint97::canRead()` answers for any OLE container, which is a good deal more than the
     * files it can parse, so a `.ppt` it chokes on used to stop the resolution where it stood.
     *
     * The first failure is carried as the previous exception, because it says a great deal more
     * about the file than the fact that the resolution came to nothing.
     */
    public static function load(string $pFilename): PhpPresentation
    {
        $firstFailure = null;

        // Try loading using self::$autoResolveClasses
        foreach (self::$autoResolveClasses as $autoResolveClass) {
            $reader = self::createReader($autoResolveClass);
            if (!$reader->canRead($pFilename)) {
                continue;
            }

            try {
                return $reader->load($pFilename);
            } catch (Throwable $exception) {
                $firstFailure = $firstFailure ?? $exception;
            }
        }

        throw new InvalidFileFormatException(
            $pFilename,
            self::class,
            'Could not automatically determine the good ' . ReaderInterface::class,
            $firstFailure
        );
    }

    /**
     * Load class.
     *
     * @return object
     */
    private static function loadClass(string $class, string $type, ?PhpPresentation $phpPresentation = null)
    {
        if (!class_exists($class)) {
            throw new InvalidClassException($class, $type . ': The class doesn\'t exist');
        }
        if (!self::isConcreteClass($class)) {
            throw new InvalidClassException($class, $type . ': The class is an abstract class or an interface');
        }
        if (null === $phpPresentation) {
            return new $class();
        }

        return new $class($phpPresentation);
    }

    /**
     * Is it a concrete class?
     */
    private static function isConcreteClass(string $class): bool
    {
        $reflection = new ReflectionClass($class);

        return !$reflection->isAbstract() && !$reflection->isInterface();
    }
}
