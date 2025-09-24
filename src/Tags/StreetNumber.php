<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class StreetNumber extends Tag {
    use Makeable;

    private ?string $streetNumber = null;

    public function setStreetNumber(string $streetNumber): self {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('NumeroCivico', $this->streetNumber);
    }
}
