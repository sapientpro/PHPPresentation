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
use ZipArchive;

/**
 * An Open Packaging Conventions package: a zip holding parts, the type of each part, and
 * the relationships between them.
 *
 * This is the layer every OOXML format shares -- a .pptx, a .docx and a .xlsx differ in
 * what their parts say, not in how the package is built. Nothing here knows what a slide
 * is.
 */
final class Package
{
    /** @var null|ZipArchive the file this was opened from, kept for reading parts on demand */
    private $zip;

    /** @var ContentTypes */
    private $contentTypes;

    /** @var array<string, bool> the names the package holds, whether or not they are loaded */
    private $names = [];

    /** @var array<string, Part> the parts read or added so far, keyed by name */
    private $parts = [];

    /** @var Relationships the relationships of the package itself */
    private $relationships;

    private function __construct()
    {
        $this->contentTypes = new ContentTypes();
        $this->relationships = new Relationships('/');
    }

    /**
     * An empty package, holding nothing but the two parts every package has.
     */
    public static function create(): self
    {
        $instance = new self();
        $instance->contentTypes->addDefault('rels', 'application/vnd.openxmlformats-package.relationships+xml');
        $instance->contentTypes->addDefault('xml', 'application/xml');

        return $instance;
    }

    public static function open(string $file): self
    {
        $zip = new ZipArchive();
        $opened = $zip->open($file);
        if (true !== $opened) {
            throw new OpcException(sprintf('The package "%s" could not be opened (error %s)', $file, (string) $opened));
        }
        $instance = new self();
        $instance->zip = $zip;
        for ($index = 0; $index < $zip->numFiles; ++$index) {
            $name = $zip->getNameIndex($index);
            if (false === $name || '/' === substr($name, -1)) {
                continue;
            }
            $instance->names['/' . ltrim($name, '/')] = true;
        }
        $types = $instance->read(ContentTypes::PART_NAME);
        $instance->contentTypes = ContentTypes::fromXml(null === $types ? '' : $types);
        $packageRels = $instance->read(PartName::relationshipsFor('/'));
        $instance->relationships = Relationships::fromXml(null === $packageRels ? '' : $packageRels, '/');

        return $instance;
    }

    /**
     * The names of every part the package holds, the content types and the relationship
     * parts aside: those two are the package describing itself, not its content.
     *
     * @return array<int, string>
     */
    public function getPartNames(): array
    {
        $names = [];
        foreach (array_keys($this->names + $this->parts) as $name) {
            if (ContentTypes::PART_NAME === $name || $this->isRelationshipPart($name)) {
                continue;
            }
            $names[] = $name;
        }
        sort($names);

        return $names;
    }

    public function hasPart(string $name): bool
    {
        $name = PartName::normalise($name);

        return isset($this->parts[$name]) || isset($this->names[$name]);
    }

    public function getPart(string $name): ?Part
    {
        $name = PartName::normalise($name);
        if (isset($this->parts[$name])) {
            return $this->parts[$name];
        }
        $content = $this->read($name);
        if (null === $content) {
            return null;
        }
        $part = new Part($name, (string) $this->contentTypes->typeOf($name), $content);
        $part->setRelationships($this->getRelationships($name));
        $this->parts[$name] = $part;

        return $part;
    }

    public function addPart(Part $part): self
    {
        $this->parts[$part->getName()] = $part;
        $this->names[$part->getName()] = true;
        $this->contentTypes->record($part->getName(), $part->getContentType());

        return $this;
    }

    public function removePart(string $name): self
    {
        $name = PartName::normalise($name);
        unset($this->parts[$name], $this->names[$name]);
        $this->contentTypes->forget($name);

        return $this;
    }

    /**
     * The relationships declared by a part, or by the package when asked for `/`.
     */
    public function getRelationships(string $partName = '/'): Relationships
    {
        $partName = PartName::normalise($partName);
        if ('/' === $partName) {
            return $this->relationships;
        }
        if (isset($this->parts[$partName])) {
            $part = $this->parts[$partName];
            if ($part->hasRelationships()) {
                return $part->getRelationships();
            }
        }
        $content = $this->read(PartName::relationshipsFor($partName));

        return Relationships::fromXml(null === $content ? '' : $content, $partName);
    }

    /**
     * The part a relationship of `$partName` points at, followed by type. Reading a
     * package is mostly this: from the package to its document, from the document to its
     * slides, from a slide to its images.
     *
     * @return array<int, Part>
     */
    public function getRelatedParts(string $partName, string $type): array
    {
        $parts = [];
        foreach ($this->getRelationships($partName)->ofType($type) as $relationship) {
            if ($relationship->isExternal()) {
                continue;
            }
            $part = $this->getPart($relationship->getTargetPartName());
            if (null !== $part) {
                $parts[] = $part;
            }
        }

        return $parts;
    }

    public function getContentTypes(): ContentTypes
    {
        return $this->contentTypes;
    }

    public function save(string $file): void
    {
        $zip = new ZipArchive();
        $opened = $zip->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if (true !== $opened) {
            throw new OpcException(sprintf('The package "%s" could not be written (error %s)', $file, (string) $opened));
        }
        $zip->addFromString(ltrim(ContentTypes::PART_NAME, '/'), $this->contentTypes->toXml());
        if (!$this->relationships->isEmpty()) {
            $zip->addFromString(ltrim(PartName::relationshipsFor('/'), '/'), $this->relationships->toXml());
        }
        foreach ($this->getPartNames() as $name) {
            $part = $this->getPart($name);
            if (null === $part) {
                continue;
            }
            $zip->addFromString(ltrim($name, '/'), $part->getContent());
            if ($part->hasRelationships()) {
                $zip->addFromString(ltrim(PartName::relationshipsFor($name), '/'), $part->getRelationships()->toXml());
            }
        }
        $zip->close();
    }

    public function close(): void
    {
        if (null !== $this->zip) {
            $this->zip->close();
            $this->zip = null;
        }
    }

    private function read(string $name): ?string
    {
        if (null === $this->zip) {
            return null;
        }
        $content = $this->zip->getFromName(ltrim(PartName::normalise($name), '/'));

        return false === $content ? null : $content;
    }

    private function isRelationshipPart(string $name): bool
    {
        return 'rels' === PartName::extension($name) && false !== strpos($name, '/_rels/');
    }
}
