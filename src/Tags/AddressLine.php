<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class AddressLine extends Tag {
    use Makeable;

    private ?string $value = null;

    public function setAddressLine(string $value): self {
        $this->value = $value;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('Indirizzo', $this->value);
    }
}
