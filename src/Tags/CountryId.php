<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class CountryId extends Tag {
    use Makeable;

    private ?string $id = null;

    public function setId(string $id): self {
        $this->id = $id;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('IdPaese', $this->id);
    }
}
