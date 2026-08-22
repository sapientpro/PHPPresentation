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

use DOMDocument;
use DOMElement;
use DOMXPath;

/**
 * Reads an OOXML schema and hands back what a binding needs to know about it: for each
 * complex type, the attributes it allows and the children it allows, in the order the
 * sequence declares them.
 *
 * This runs at development time. What it produces is checked in, so nothing parses a
 * 9000-line XSD at runtime.
 */
final class XsdParser
{
    private const XSD = 'http://www.w3.org/2001/XMLSchema';

    /** @var DOMXPath */
    private $xpath;

    /** @var array<string, DOMElement> */
    private $complexTypes = [];

    /** @var array<string, DOMElement> */
    private $simpleTypes = [];

    /** @var array<string, DOMElement> */
    private $groups = [];

    /** @var array<string, DOMElement> */
    private $attributeGroups = [];

    public function __construct(string $xsdFile)
    {
        $document = new DOMDocument();
        $document->load($xsdFile);
        $this->xpath = new DOMXPath($document);
        $this->xpath->registerNamespace('xsd', self::XSD);
        foreach ([['complexType', 'complexTypes'], ['simpleType', 'simpleTypes'], ['group', 'groups'], ['attributeGroup', 'attributeGroups']] as $pair) {
            foreach ($this->xpath->query('/xsd:schema/xsd:' . $pair[0] . '[@name]') ?: [] as $node) {
                if ($node instanceof DOMElement) {
                    $this->{$pair[1]}[$node->getAttribute('name')] = $node;
                }
            }
        }
    }

    /**
     * The specification of every type reachable from the given roots, expanded while the
     * budget lasts. A type the budget does not reach is recorded as opaque: the binding
     * carries it as it stands rather than pretending to understand it.
     *
     * @param array<int, string> $roots
     *
     * @return array<string, array{attributes: array<string, array{type: string, values: array<int, string>, default: ?string}>, children: array<int, array{name: string, type: string, repeated: bool}>, opaque: bool}>
     */
    public function specify(array $roots, int $depth = 2): array
    {
        $specs = [];
        $queue = [];
        foreach ($roots as $root) {
            $queue[] = [$root, 0];
        }
        while ($queue) {
            $entry = array_shift($queue);
            [$name, $level] = $entry;
            if (isset($specs[$name]) || !isset($this->complexTypes[$name])) {
                continue;
            }
            if ($level > $depth) {
                $specs[$name] = ['attributes' => [], 'children' => [], 'opaque' => true];

                continue;
            }
            $node = $this->complexTypes[$name];
            $spec = [
                'attributes' => $this->attributesOf($node),
                'children' => $this->childrenOf($node),
                'opaque' => false,
            ];
            $specs[$name] = $spec;
            foreach ($spec['children'] as $child) {
                $queue[] = [$child['type'], $level + 1];
            }
        }
        ksort($specs);

        return $specs;
    }

    /**
     * @return array<string, array{type: string, values: array<int, string>, default: ?string}>
     */
    private function attributesOf(DOMElement $type): array
    {
        $attributes = [];
        foreach ($this->xpath->query('.//xsd:attribute[@name]', $type) ?: [] as $node) {
            if (!($node instanceof DOMElement)) {
                continue;
            }
            $default = $node->hasAttribute('default') ? $node->getAttribute('default') : null;
            $attributes[$node->getAttribute('name')] = $this->kindOf($node->getAttribute('type')) + ['default' => $default];
        }
        foreach ($this->xpath->query('.//xsd:attributeGroup[@ref]', $type) ?: [] as $node) {
            if (!($node instanceof DOMElement)) {
                continue;
            }
            $ref = $this->localName($node->getAttribute('ref'));
            if (isset($this->attributeGroups[$ref])) {
                $attributes += $this->attributesOf($this->attributeGroups[$ref]);
            }
        }

        return $attributes;
    }

    /**
     * Children in the order the schema declares them, which is the order a valid file
     * must spell them in -- the one thing a hand-written writer has to remember and a
     * generated one cannot forget.
     *
     * @return array<int, array{name: string, type: string, repeated: bool}>
     */
    private function childrenOf(DOMElement $type, int $guard = 0): array
    {
        if ($guard > 8) {
            return [];
        }
        $children = [];
        foreach ($this->particles($type) as $node) {
            if ('element' === $node->localName && $node->hasAttribute('name')) {
                $children[] = [
                    'name' => $node->getAttribute('name'),
                    'type' => $this->localName($node->getAttribute('type')),
                    'repeated' => 'unbounded' === $node->getAttribute('maxOccurs') || (int) $node->getAttribute('maxOccurs') > 1,
                ];

                continue;
            }
            if ('group' === $node->localName && $node->hasAttribute('ref')) {
                $ref = $this->localName($node->getAttribute('ref'));
                if (isset($this->groups[$ref])) {
                    foreach ($this->childrenOf($this->groups[$ref], $guard + 1) as $child) {
                        $children[] = $child;
                    }
                }
            }
        }

        return $children;
    }

    /**
     * The element and group particles of a type, in document order, skipping anything
     * nested inside a child element's own definition.
     *
     * @return array<int, DOMElement>
     */
    private function particles(DOMElement $type): array
    {
        $particles = [];
        foreach ($this->xpath->query('.//xsd:element[@name] | .//xsd:group[@ref] | .//xsd:element[@ref]', $type) ?: [] as $node) {
            if ($node instanceof DOMElement) {
                $particles[] = $node;
            }
        }

        return $particles;
    }

    /**
     * How a value of the given schema type is spelled: a boolean, a number, one of a
     * closed list of words, or a string nobody constrains.
     *
     * @return array{type: string, values: array<int, string>}
     */
    private function kindOf(string $typeName): array
    {
        $name = $this->localName($typeName);
        if (0 === strpos($typeName, 'xsd:')) {
            return ['type' => $this->scalar($name), 'values' => []];
        }
        if (!isset($this->simpleTypes[$name])) {
            return ['type' => 'string', 'values' => []];
        }
        $node = $this->simpleTypes[$name];
        $values = [];
        foreach ($this->xpath->query('.//xsd:enumeration[@value]', $node) ?: [] as $enum) {
            if ($enum instanceof DOMElement) {
                $values[] = $enum->getAttribute('value');
            }
        }
        if ($values) {
            return ['type' => 'enum', 'values' => $values];
        }
        $restriction = $this->xpath->query('.//xsd:restriction[@base]', $node);
        if ($restriction && $restriction->length > 0) {
            $base = $restriction->item(0);
            if ($base instanceof DOMElement) {
                $baseName = $base->getAttribute('base');
                if (0 === strpos($baseName, 'xsd:')) {
                    return ['type' => $this->scalar($this->localName($baseName)), 'values' => []];
                }

                return $this->kindOf($baseName);
            }
        }

        return ['type' => 'string', 'values' => []];
    }

    private function scalar(string $name): string
    {
        if ('boolean' === $name) {
            return 'bool';
        }
        if (in_array($name, ['int', 'integer', 'long', 'unsignedInt', 'unsignedLong', 'byte', 'unsignedByte', 'short', 'unsignedShort'], true)) {
            return 'int';
        }
        if (in_array($name, ['double', 'float', 'decimal'], true)) {
            return 'float';
        }

        return 'string';
    }

    private function localName(string $qualified): string
    {
        $colon = strpos($qualified, ':');

        return false === $colon ? $qualified : substr($qualified, $colon + 1);
    }
}
