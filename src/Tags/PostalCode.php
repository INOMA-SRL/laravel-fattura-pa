<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PostalCode extends Tag {
    use Makeable;

    private ?string $postalCode = null;

    public function setPostalCode(string $postalCode): self {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('CAP', $this->postalCode);
    }
}
