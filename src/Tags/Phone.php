<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Phone extends Tag {
    use Makeable;

    private ?string $phone = null;

    public function setPhone(string $phone): self {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('Telefono', $this->phone);
    }
}
