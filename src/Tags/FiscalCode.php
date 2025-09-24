<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class FiscalCode extends Tag {
    use Makeable;

    private ?string $code = null;

    public function setFiscalCode(string $code): self {
        $this->code = $code;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('CodiceFiscale', $this->code);
    }
}
