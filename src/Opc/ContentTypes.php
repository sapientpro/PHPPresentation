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

use DOMDocument;
use DOMElement;

/**
 * `[Content_Types].xml` -- the one part of a package that is addressed by neither a name
 * nor a relationship, and that says what every other part is.
 *
 * A type is looked up by the part's extension first (`Default`), and overridden for a
 * single part by name (`Override`).
 */
final class ContentTypes
{
    public const PART_NAME = '/[Content_Types].xml';

    private const NS = 'http://schemas.openxmlformats.org/package/2006/content-types';

    /**
     * @var array<string, string> content type, keyed by lowercased extension
     */
    private $defaults = [];

    /**
     * @var array<string, string> content type, keyed by part name
     */
    private $overrides = [];

    public static function fromXml(string $xml): self
    {
        $instance = new self();
        $document = new DOMDocument();
        if ('' === trim($xml) || !@$document->loadXML($xml)) {
            return $instance;
        }
        foreach ($document->getElementsByTagNameNS(self::NS, 'Default') as $node) {
            if ($node instanceof DOMElement) {
                $instance->addDefault($node->getAttribute('Extension'), $node->getAttribute('ContentType'));
            }
        }
        foreach ($document->getElementsByTagNameNS(self::NS, 'Override') as $node) {
            if ($node instanceof DOMElement) {
                $instance->addOverride($node->getAttribute('PartName'), $node->getAttribute('ContentType'));
            }
        }

        return $instance;
    }

    public function addDefault(string $extension, string $contentType): self
    {
        $this->defaults[strtolower($extension)] = $contentType;

        return $this;
    }

    public function addOverride(string $partName, string $contentType): self
    {
        $this->overrides[PartName::normalise($partName)] = $contentType;

        return $this;
    }

    public function typeOf(string $partName): ?string
    {
        $partName = PartName::normalise($partName);
        if (isset($this->overrides[$partName])) {
            return $this->overrides[$partName];
        }
        $extension = PartName::extension($partName);

        return $this->defaults[$extension] ?? null;
    }

    /**
     * Records the type of a part the cheapest way the package allows: as a default when
     * every part with that extension shares the type, as an override when it does not.
     */
    public function record(string $partName, string $contentType): self
    {
        $extension = PartName::extension($partName);
        if ('' !== $extension) {
            if (!isset($this->defaults[$extension])) {
                return $this->addDefault($extension, $contentType);
            }
            if ($this->defaults[$extension] === $contentType) {
                return $this;
            }
        }

        return $this->addOverride($partName, $contentType);
    }

    public function forget(string $partName): self
    {
        unset($this->overrides[PartName::normalise($partName)]);

        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    /**
     * @return array<string, string>
     */
    public function getOverrides(): array
    {
        return $this->overrides;
    }

    public function toXml(): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->standalone = true;
        $root = $document->createElementNS(self::NS, 'Types');
        $document->appendChild($root);
        foreach ($this->defaults as $extension => $contentType) {
            $node = $document->createElementNS(self::NS, 'Default');
            $node->setAttribute('Extension', $extension);
            $node->setAttribute('ContentType', $contentType);
            $root->appendChild($node);
        }
        foreach ($this->overrides as $partName => $contentType) {
            $node = $document->createElementNS(self::NS, 'Override');
            $node->setAttribute('PartName', $partName);
            $node->setAttribute('ContentType', $contentType);
            $root->appendChild($node);
        }

        return (string) $document->saveXML();
    }
}
