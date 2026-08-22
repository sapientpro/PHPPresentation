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

namespace PhpOffice\PhpPresentation\OpenXml;

use PhpOffice\PhpPresentation\Shape\RichText\Run;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Font;

/**
 * The whole of what the library knows about `a:rPr`, said once.
 *
 * Everything else -- which attributes exist, what they are called, what order the
 * children go in, how a boolean is spelled -- comes from the schema. This says only how
 * the model's idea of a font lines up with it, and it says it in one direction, because
 * the other direction is the same table read backwards.
 */
final class FontBinding
{
    public const TYPE = 'CT_TextCharacterProperties';

    /**
     * @return array<string, mixed>
     */
    public static function fromRun(Run $run): array
    {
        $font = $run->getFont();
        $language = $run->getLanguage();

        return [
            '@lang' => '' === (string) $language ? 'en-US' : $language,
            '@b' => $font->isBold() ? true : null,
            '@i' => $font->isItalic() ? true : null,
            '@strike' => $font->getStrikethrough(),
            '@sz' => (int) ($font->getSize() * 100),
            '@spc' => $font->getCharacterSpacing(),
            '@u' => $font->getUnderline(),
            '@cap' => $font->getCapitalization(),
            '@baseline' => 0 === $font->getBaseline() ? null : $font->getBaseline(),
            'solidFill' => [
                'srgbClr' => [
                    '@val' => $font->getColor()->getRGB(),
                    'alpha' => ['@val' => $font->getColor()->getAlpha() * 1000],
                ],
            ],
            $font->getFormat() => self::typeface($font),
        ];
    }

    /**
     * @param array<string, mixed> $values
     */
    public static function toFont(array $values, ?Font $font = null): Font
    {
        $font = $font ?? new Font();
        $font->setBold(isset($values['@b']) && true === $values['@b']);
        $font->setItalic(isset($values['@i']) && true === $values['@i']);
        if (isset($values['@strike'])) {
            $font->setStrikethrough((string) $values['@strike']);
        }
        if (isset($values['@sz'])) {
            // both are hundredths of a point in the file, and whole units in the model
            $font->setSize((int) round((int) $values['@sz'] / 100));
        }
        if (isset($values['@spc'])) {
            $font->setCharacterSpacing((float) $values['@spc'] / 100);
        }
        if (isset($values['@u'])) {
            $font->setUnderline((string) $values['@u']);
        }
        if (isset($values['@cap'])) {
            $font->setCapitalization((string) $values['@cap']);
        }
        $font->setBaseline(isset($values['@baseline']) ? (int) $values['@baseline'] : 0);
        $rgb = $values['solidFill']['srgbClr']['@val'] ?? null;
        if (null !== $rgb) {
            $alpha = $values['solidFill']['srgbClr']['alpha']['@val'] ?? null;
            $font->setColor(new Color((null === $alpha ? 'FF' : self::alphaToHex((int) $alpha)) . (string) $rgb));
        }
        foreach ([Font::FORMAT_LATIN, Font::FORMAT_EAST_ASIAN, Font::FORMAT_COMPLEX_SCRIPT] as $format) {
            if (!isset($values[$format])) {
                continue;
            }
            $font->setFormat($format);
            $typeface = $values[$format];
            if (isset($typeface['@typeface'])) {
                $font->setName((string) $typeface['@typeface']);
            }
            if (isset($typeface['@panose'])) {
                $font->setPanose(implode('', array_map(static function (string $pair): string {
                    return substr($pair, 1);
                }, (array) str_split((string) $typeface['@panose'], 2))));
            }
            if (isset($typeface['@pitchFamily'])) {
                $font->setPitchFamily((int) $typeface['@pitchFamily']);
            }
            if (isset($typeface['@charset'])) {
                // the schema calls this a byte and the reader reads it as one; the writer
                // spells it in hexadecimal, which is the disagreement BindingTest pins
                $font->setCharset((int) $typeface['@charset']);
            }
        }

        return $font;
    }

    /**
     * @return array<string, mixed>
     */
    private static function typeface(Font $font): array
    {
        $values = ['@typeface' => $font->getName()];
        if ('' !== $font->getPanose()) {
            $values['@panose'] = implode('', array_map(static function (string $value): string {
                return '0' . $value;
            }, (array) str_split($font->getPanose())));
        }
        if (0 !== $font->getPitchFamily()) {
            $values['@pitchFamily'] = $font->getPitchFamily();
        }
        if (Font::CHARSET_DEFAULT !== $font->getCharset()) {
            $values['@charset'] = dechex($font->getCharset());
        }

        return $values;
    }

    private static function alphaToHex(int $alpha): string
    {
        return str_pad(strtoupper(dechex((int) round($alpha / 1000 * 255 / 100))), 2, '0', STR_PAD_LEFT);
    }
}
