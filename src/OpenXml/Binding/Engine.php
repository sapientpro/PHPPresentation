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

namespace PhpOffice\OpenXml\Binding;

use DOMDocument;
use DOMElement;
use PhpOffice\OpenXml\Exception\SchemaException;
use PhpOffice\OpenXml\Schema\Schema;

/**
 * Reads and writes an element from the same description of it.
 *
 * A value tree is a plain array: attributes under their name prefixed with `@`, children
 * under their name, a repeated child under a list. Nothing here knows what any of it
 * means -- that is the mapping's business, and the mapping is the only hand-written part
 * left.
 */
final class Engine
{
    /** @var Schema */
    private $schema;

    /** @var string */
    private $namespace;

    /** @var string */
    private $prefix;

    public function __construct(Schema $schema, string $namespace, string $prefix)
    {
        $this->schema = $schema;
        $this->namespace = $namespace;
        $this->prefix = $prefix;
    }

    /**
     * @param array<string, mixed> $values
     */
    public function write(DOMDocument $document, string $name, string $type, array $values): DOMElement
    {
        $spec = $this->schema->type($type);
        $element = $document->createElementNS($this->namespace, $this->prefix . ':' . $name);

        $known = [];
        foreach ($spec['attributes'] as $attribute => $kind) {
            $known['@' . $attribute] = true;
            if (!array_key_exists('@' . $attribute, $values) || null === $values['@' . $attribute]) {
                continue;
            }
            $element->setAttribute($attribute, $this->encode($values['@' . $attribute], $kind, $attribute));
        }
        // in schema order: a file whose children are out of order is invalid, and the
        // order is the one thing a generated writer cannot get wrong
        foreach ($spec['children'] as $child) {
            $known[$child['name']] = true;
            if (!array_key_exists($child['name'], $values) || null === $values[$child['name']]) {
                continue;
            }
            $value = $values[$child['name']];
            $items = $child['repeated'] ? $value : [$value];
            /** @var array<int, array<string, mixed>> $items */
            foreach ($items as $item) {
                $element->appendChild($this->write($document, $child['name'], $child['type'], $item));
            }
        }
        foreach (array_keys($values) as $key) {
            if (!isset($known[$key])) {
                throw new SchemaException(sprintf('"%s" holds no "%s"', $type, $key));
            }
        }

        return $element;
    }

    /**
     * @return array<string, mixed>
     */
    public function read(DOMElement $element, string $type): array
    {
        $spec = $this->schema->type($type);
        $values = [];
        foreach ($spec['attributes'] as $attribute => $kind) {
            if (!$element->hasAttribute($attribute)) {
                continue;
            }
            $values['@' . $attribute] = $this->decode($element->getAttribute($attribute), $kind);
        }
        foreach ($spec['children'] as $child) {
            $found = [];
            foreach ($element->childNodes as $node) {
                if ($node instanceof DOMElement && $node->localName === $child['name'] && $node->namespaceURI === $this->namespace) {
                    $found[] = $this->read($node, $child['type']);
                }
            }
            if ([] === $found) {
                continue;
            }
            $values[$child['name']] = $child['repeated'] ? $found : $found[0];
        }

        return $values;
    }

    /**
     * @param mixed $value
     * @param array{type: string, values: array<int, string>, default: ?string} $kind
     */
    private function encode($value, array $kind, string $attribute): string
    {
        if ('bool' === $kind['type']) {
            return $value ? '1' : '0';
        }
        if ('int' === $kind['type']) {
            return (string) (int) $value;
        }
        if ('float' === $kind['type']) {
            return rtrim(rtrim(sprintf('%.6F', (float) $value), '0'), '.');
        }
        $value = (string) $value;
        if ('enum' === $kind['type'] && !in_array($value, $kind['values'], true)) {
            throw new SchemaException(sprintf('"%s" is not a value the schema allows for "%s"', $value, $attribute));
        }

        return $value;
    }

    /**
     * @param array{type: string, values: array<int, string>, default: ?string} $kind
     *
     * @return bool|float|int|string
     */
    private function decode(string $value, array $kind)
    {
        if ('bool' === $kind['type']) {
            return in_array(strtolower($value), ['1', 'true', 'on'], true);
        }
        if ('int' === $kind['type']) {
            return (int) $value;
        }
        if ('float' === $kind['type']) {
            return (float) $value;
        }

        return $value;
    }
}
