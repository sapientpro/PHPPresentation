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
use PhpOffice\Opc\Exception\OpcException;

/**
 * One part of a package: a name, a content type, and bytes. What those bytes mean is the
 * business of whoever asked for the part, not of this layer.
 */
final class Part
{
    /** @var string */
    private $name;

    /** @var string */
    private $contentType;

    /** @var string */
    private $content;

    /** @var null|Relationships built on demand: most parts declare none */
    private $relationships;

    public function __construct(string $name, string $contentType, string $content = '')
    {
        $this->name = PartName::normalise($name);
        $this->contentType = $contentType;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDocument(): DOMDocument
    {
        $document = new DOMDocument();
        if (!@$document->loadXML($this->content)) {
            throw new OpcException(sprintf('The part "%s" does not hold a well-formed XML document', $this->name));
        }

        return $document;
    }

    public function setDocument(DOMDocument $document): self
    {
        return $this->setContent((string) $document->saveXML());
    }

    public function getRelationships(): Relationships
    {
        if (null === $this->relationships) {
            $this->relationships = new Relationships($this->name);
        }

        return $this->relationships;
    }

    public function setRelationships(Relationships $relationships): self
    {
        $this->relationships = $relationships;

        return $this;
    }

    public function hasRelationships(): bool
    {
        return null !== $this->relationships && !$this->relationships->isEmpty();
    }
}
