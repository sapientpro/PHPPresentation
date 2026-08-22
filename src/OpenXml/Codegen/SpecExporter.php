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

namespace PhpOffice\OpenXml\Codegen;

/**
 * Writes what the parser found into a PHP file that is checked in beside the code.
 */
final class SpecExporter
{
    /**
     * @param array<string, mixed> $specs
     */
    public static function toPhp(array $specs, string $schemaFile, string $roots): string
    {
        $header = <<<'PHP_HEADER'
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

PHP_HEADER;

        return $header . sprintf(
            "\n/*\n * Generated from %s, rooted at %s, by %s.\n * Do not edit: run the generator instead, and let the test that checks it prove it is current.\n */\n\nreturn %s;\n",
            $schemaFile,
            $roots,
            self::class,
            self::export($specs)
        );
    }

    /**
     * `var_export()` with the array syntax the rest of the repository uses.
     *
     * @param mixed $value
     */
    private static function export($value, int $indent = 0): string
    {
        $pad = str_repeat('    ', $indent);
        if (!is_array($value)) {
            // `var_export()` spells the three constants in capitals, which the repository
            // does not; the generated file has to pass the same formatter as the rest
            return str_replace(['NULL', 'TRUE', 'FALSE'], ['null', 'true', 'false'], var_export($value, true));
        }
        if ([] === $value) {
            return '[]';
        }
        $isList = array_keys($value) === range(0, count($value) - 1);
        $lines = [];
        foreach ($value as $key => $item) {
            $lines[] = $pad . '    ' . ($isList ? '' : var_export($key, true) . ' => ') . self::export($item, $indent + 1) . ',';
        }

        return "[\n" . implode("\n", $lines) . "\n" . $pad . ']';
    }
}
