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
     * The readers `load()` tries, in the order it tries them.
     *
     * Pass this to `load()` to keep the ones shipped here and add one of your own, in the position
     * you want it tried.
     *
     * @return array<int, string>
     */
    public static function getDefaultReaders(): array
    {
        return self::$autoResolveClasses;
    }

    /**
     * Create writer.
     *
     * The name is either one shipped with this library (`PowerPoint2007`, `ODPresentation`, ...) or
     * the fully qualified name of a class of your own implementing `WriterInterface`.
     */
    public static function createWriter(PhpPresentation $phpPresentation, string $name = 'PowerPoint2007'): WriterInterface
    {
        /** @var WriterInterface $writer */
        $writer = self::loadClass(
            self::resolveClass('PhpOffice\\PhpPresentation\\Writer\\', $name),
            'Writer',
            WriterInterface::class,
            $phpPresentation
        );

        return $writer;
    }

    /**
     * Create reader.
     *
     * The name is either one shipped with this library (`PowerPoint2007`, `ODPresentation`, ...) or
     * the fully qualified name of a class of your own implementing `ReaderInterface`.
     */
    public static function createReader(string $name): ReaderInterface
    {
        /** @var ReaderInterface $reader */
        $reader = self::loadClass(
            self::resolveClass('PhpOffice\\PhpPresentation\\Reader\\', $name),
            'Reader',
            ReaderInterface::class
        );

        return $reader;
    }

    /**
     * Loads PhpPresentation from file using automatic ReaderInterface resolution.
     *
     * Every reader is asked in turn, and a reader that says it can read the file but then fails to
     * does not end the search: the next one is tried, and only when none of them has produced a
     * presentation is the failure raised. `PowerPoint97::canRead()` answers for any OLE container,
     * which is a good deal more than the files it can actually parse, so without this a `.ppt` it
     * chokes on used to stop the resolution where it stood. The first failure is carried on the
     * exception as its previous, because it says a great deal more than "none of them could".
     *
     * @param array<int, string> $readers the readers to try, in order, in place of the ones shipped
     *                                    here -- see `getDefaultReaders()` to keep those as well
     */
    public static function load(string $pFilename, array $readers = []): PhpPresentation
    {
        $firstFailure = null;

        foreach ($readers ?: self::$autoResolveClasses as $name) {
            $reader = self::createReader($name);
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
     * The class a name stands for: one shipped with this library, or one of your own.
     *
     * A name carrying a namespace separator is taken as it is written, so that a reader or a writer
     * living outside this namespace can be named too. A bare name is one of ours, as it always was.
     */
    private static function resolveClass(string $namespace, string $name): string
    {
        return false === strpos($name, '\\') ? $namespace . $name : $name;
    }

    /**
     * Load class.
     *
     * @param class-string $interface
     *
     * @return object
     */
    private static function loadClass(string $class, string $type, string $interface, ?PhpPresentation $phpPresentation = null)
    {
        if (!class_exists($class)) {
            throw new InvalidClassException($class, $type . ': The class doesn\'t exist');
        }
        if (!self::isConcreteClass($class)) {
            throw new InvalidClassException($class, $type . ': The class is an abstract class or an interface');
        }
        if (!is_subclass_of($class, $interface)) {
            throw new InvalidClassException($class, $type . ': The class does not implement ' . $interface);
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
