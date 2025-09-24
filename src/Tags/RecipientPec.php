<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class RecipientPec extends Tag {
    use Makeable;

    private ?string $pec = null;

    public function setPec(string $pec): self {
        $this->pec = $pec;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('PECDestinatario', $this->pec);
    }
}
