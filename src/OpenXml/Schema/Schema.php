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

namespace PhpOffice\OpenXml\Schema;

use PhpOffice\OpenXml\Exception\SchemaException;

/**
 * What the binding knows about one vocabulary: for every complex type, the attributes it
 * allows and the children it allows, in the order the schema declares them.
 */
final class Schema
{
    /** @var array<string, array{attributes: array<string, array{type: string, values: array<int, string>, default: ?string}>, children: array<int, array{name: string, type: string, repeated: bool}>, opaque: bool}> */
    private $types;

    /** @var array<string, self> */
    private static $loaded = [];

    /**
     * @param array<string, array{attributes: array<string, array{type: string, values: array<int, string>, default: ?string}>, children: array<int, array{name: string, type: string, repeated: bool}>, opaque: bool}> $types
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * The DrawingML text vocabulary, as generated from `dml-main.xsd`.
     */
    public static function drawingMLText(): self
    {
        if (!isset(self::$loaded['DrawingMLText'])) {
            /** @var array<string, array{attributes: array<string, array{type: string, values: array<int, string>, default: ?string}>, children: array<int, array{name: string, type: string, repeated: bool}>, opaque: bool}> $types */
            $types = require __DIR__ . '/Generated/DrawingMLText.php';
            self::$loaded['DrawingMLText'] = new self($types);
        }

        return self::$loaded['DrawingMLText'];
    }

    public function has(string $type): bool
    {
        return isset($this->types[$type]);
    }

    /**
     * @return array{attributes: array<string, array{type: string, values: array<int, string>, default: ?string}>, children: array<int, array{name: string, type: string, repeated: bool}>, opaque: bool}
     */
    public function type(string $type): array
    {
        if (!isset($this->types[$type])) {
            throw new SchemaException(sprintf('The schema holds no type named "%s"', $type));
        }

        return $this->types[$type];
    }

    /**
     * @return array<int, string>
     */
    public function names(): array
    {
        return array_keys($this->types);
    }
}
