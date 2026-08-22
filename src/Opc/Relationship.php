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

/**
 * One entry of a `.rels` part: the only way a part names another part.
 */
final class Relationship
{
    public const MODE_INTERNAL = 'Internal';
    public const MODE_EXTERNAL = 'External';

    /** @var string */
    private $identifier;

    /** @var string */
    private $type;

    /** @var string */
    private $target;

    /** @var string */
    private $targetMode;

    /** @var string the part that declares it, so that a relative target can be resolved */
    private $source;

    public function __construct(string $identifier, string $type, string $target, string $targetMode = self::MODE_INTERNAL, string $source = '/')
    {
        $this->identifier = $identifier;
        $this->type = $type;
        $this->target = $target;
        $this->targetMode = $targetMode;
        $this->source = $source;
    }

    public function getId(): string
    {
        return $this->identifier;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getTargetMode(): string
    {
        return $this->targetMode;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function isExternal(): bool
    {
        return self::MODE_EXTERNAL === $this->targetMode;
    }

    /**
     * The absolute name of the part this points at, or the target as it stands when it
     * points outside the package.
     */
    public function getTargetPartName(): string
    {
        if ($this->isExternal()) {
            return $this->target;
        }

        return PartName::resolve($this->source, $this->target);
    }
}
