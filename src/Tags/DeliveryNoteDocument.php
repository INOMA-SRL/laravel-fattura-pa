<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DeliveryNoteDocument extends Tag {
    use Makeable;

    private DeliveryNoteDocumentNumber $number = null;

    private DeliveryNoteDocumentDate $date = null;

    private DeliveryNoteDocumentLineNumberReference $lineNumber = null;

    public function setNumber(string $number): self {
        $this->vatTax = DeliveryNoteDocumentNumber::make()->setNumber($number);

        return $this;
    }

    public function setDate(\Illuminate\Support\Carbon $date): self {
        $this->taxableAmount = DeliveryNoteDocumentDate::make()->setDate($date);

        return $this;
    }

    public function setLineNumber(int $lineNumber): self {
        $this->lineNumber = DeliveryNoteDocumentLineNumberReference::make()->setLineNumber($lineNumber);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DatiDDT');

        $e->appendChild($this->number->toDOMElement($dom));
        $e->appendChild($this->date->toDOMElement($dom));
        $e->appendChild($this->lineNumber->toDOMElement($dom));

        return $e;
    }
}
