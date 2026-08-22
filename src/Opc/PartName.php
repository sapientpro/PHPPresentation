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

namespace PhpOffice\Opc;

use PhpOffice\Opc\Exception\OpcException;

/**
 * The naming rules of a package part, which are pure string work and worth having in one
 * place: a part is addressed by an absolute name, a relationship target is written
 * relative to the part that holds it, and the relationships of a part live in a part of
 * their own whose name is derived from it.
 */
final class PartName
{
    public static function normalise(string $name): string
    {
        if ('' === $name) {
            throw new OpcException('A part name cannot be empty');
        }
        $name = str_replace('\\', '/', $name);
        if ('/' !== $name[0]) {
            $name = '/' . $name;
        }
        if ('/' !== $name && '/' === substr($name, -1)) {
            throw new OpcException(sprintf('A part name cannot end with a separator, "%s" does', $name));
        }

        return $name;
    }

    /**
     * The name of the part holding the relationships of the given part -- and, for the
     * package itself, `/_rels/.rels`.
     */
    public static function relationshipsFor(string $name): string
    {
        $name = self::normalise($name);
        if ('/' === $name) {
            return '/_rels/.rels';
        }

        return self::directory($name) . '/_rels/' . self::basename($name) . '.rels';
    }

    /**
     * The part a relationship target names, resolved against the part that declares it.
     * An external target is returned as it stands: it names nothing inside the package.
     */
    public static function resolve(string $source, string $target): string
    {
        if (self::isExternal($target)) {
            return $target;
        }
        if ('' !== $target && '/' === $target[0]) {
            return self::normalise($target);
        }
        $base = '/' === $source ? '' : self::directory(self::normalise($source));
        $segments = [];
        foreach (explode('/', $base . '/' . $target) as $segment) {
            if ('' === $segment || '.' === $segment) {
                continue;
            }
            if ('..' === $segment) {
                array_pop($segments);

                continue;
            }
            $segments[] = $segment;
        }

        return '/' . implode('/', $segments);
    }

    /**
     * The target to write into a relationship of `$source` so that it names `$part`.
     */
    public static function relativise(string $source, string $part): string
    {
        if (self::isExternal($part)) {
            return $part;
        }
        $from = explode('/', trim('/' === $source ? '' : self::directory(self::normalise($source)), '/'));
        $target = explode('/', trim(self::normalise($part), '/'));
        $from = array_values(array_filter($from, static function (string $segment): bool {
            return '' !== $segment;
        }));
        while ($from && $target && $from[0] === $target[0] && count($target) > 1) {
            array_shift($from);
            array_shift($target);
        }

        return str_repeat('../', count($from)) . implode('/', $target);
    }

    public static function extension(string $name): string
    {
        $basename = self::basename(self::normalise($name));
        $dot = strrpos($basename, '.');

        return false === $dot ? '' : strtolower(substr($basename, $dot + 1));
    }

    public static function isExternal(string $target): bool
    {
        return (bool) preg_match('#^[a-zA-Z][a-zA-Z0-9+.-]*://#', $target)
            || 0 === strpos($target, 'mailto:');
    }

    private static function directory(string $name): string
    {
        $slash = strrpos($name, '/');

        return false === $slash || 0 === $slash ? '' : substr($name, 0, $slash);
    }

    private static function basename(string $name): string
    {
        $slash = strrpos($name, '/');

        return false === $slash ? $name : substr($name, $slash + 1);
    }
}
