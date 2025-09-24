<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class RecipientCode extends Tag {
    use Makeable;

    private ?string $code = null;

    public function setCode(string $code): self {
        $this->code = $code;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('CodiceDestinatario', $this->code);
    }
}
