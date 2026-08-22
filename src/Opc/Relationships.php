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

use ArrayIterator;
use DOMDocument;
use DOMElement;
use IteratorAggregate;
use Traversable;

/**
 * The relationships declared by one part (or by the package itself).
 *
 * @implements IteratorAggregate<string, Relationship>
 */
final class Relationships implements IteratorAggregate
{
    private const NS = 'http://schemas.openxmlformats.org/package/2006/relationships';

    /** @var string the part these belong to */
    private $source;

    /** @var array<string, Relationship> keyed by id */
    private $items = [];

    public function __construct(string $source = '/')
    {
        $this->source = $source;
    }

    public static function fromXml(string $xml, string $source = '/'): self
    {
        $instance = new self($source);
        $document = new DOMDocument();
        if ('' === trim($xml) || !@$document->loadXML($xml)) {
            return $instance;
        }
        foreach ($document->getElementsByTagNameNS(self::NS, 'Relationship') as $node) {
            if (!($node instanceof DOMElement)) {
                continue;
            }
            $mode = $node->getAttribute('TargetMode');
            $instance->add(new Relationship(
                $node->getAttribute('Id'),
                $node->getAttribute('Type'),
                $node->getAttribute('Target'),
                '' === $mode ? Relationship::MODE_INTERNAL : $mode,
                $source
            ));
        }

        return $instance;
    }

    public function add(Relationship $relationship): self
    {
        $this->items[$relationship->getId()] = $relationship;

        return $this;
    }

    /**
     * Declares a relationship on a target given by its absolute part name, which is the
     * form the rest of the library thinks in; the relative form the file needs is derived.
     */
    public function relate(string $type, string $partName, ?string $identifier = null, string $targetMode = Relationship::MODE_INTERNAL): Relationship
    {
        $identifier = $identifier ?? $this->nextId();
        $target = Relationship::MODE_EXTERNAL === $targetMode
            ? $partName
            : PartName::relativise($this->source, $partName);
        $relationship = new Relationship($identifier, $type, $target, $targetMode, $this->source);
        $this->add($relationship);

        return $relationship;
    }

    public function get(string $identifier): ?Relationship
    {
        return $this->items[$identifier] ?? null;
    }

    /**
     * @return array<int, Relationship>
     */
    public function ofType(string $type): array
    {
        return array_values(array_filter($this->items, static function (Relationship $relationship) use ($type): bool {
            return $relationship->getType() === $type;
        }));
    }

    public function firstOfType(string $type): ?Relationship
    {
        $found = $this->ofType($type);

        return $found[0] ?? null;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return [] === $this->items;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return Traversable<string, Relationship>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function toXml(): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->standalone = true;
        $root = $document->createElementNS(self::NS, 'Relationships');
        $document->appendChild($root);
        foreach ($this->items as $relationship) {
            $node = $document->createElementNS(self::NS, 'Relationship');
            $node->setAttribute('Id', $relationship->getId());
            $node->setAttribute('Type', $relationship->getType());
            $node->setAttribute('Target', $relationship->getTarget());
            if ($relationship->isExternal()) {
                $node->setAttribute('TargetMode', Relationship::MODE_EXTERNAL);
            }
            $root->appendChild($node);
        }

        return (string) $document->saveXML();
    }

    private function nextId(): string
    {
        $next = $this->count() + 1;
        while (isset($this->items['rId' . $next])) {
            ++$next;
        }

        return 'rId' . $next;
    }
}
