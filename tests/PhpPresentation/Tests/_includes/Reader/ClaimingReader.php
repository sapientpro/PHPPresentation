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

namespace PhpOffice\PhpPresentation\Tests\Reader;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\Reader\ReaderInterface;
use RuntimeException;

/**
 * A reader that says it can read anything and then cannot, which is what `PowerPoint97` does to
 * every OLE container it is handed and cannot parse.
 */
class ClaimingReader implements ReaderInterface
{
    public const FAILURE = 'ClaimingReader claimed a file it cannot read';

    public function canRead(string $pFilename): bool
    {
        return true;
    }

    public function load(string $pFilename, int $flags = 0): PhpPresentation
    {
        throw new RuntimeException(self::FAILURE);
    }
}
