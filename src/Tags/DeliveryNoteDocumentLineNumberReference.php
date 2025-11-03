<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DeliveryNoteDocumentLineNumberReference extends Tag {
    use Makeable;

    private ?int $lineNumber = null;

    public function setLineNumber(int $lineNumber): self {
        $this->lineNumber = $lineNumber;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('RiferimentoNumeroLinea', (string) $this->lineNumber);
    }
}
