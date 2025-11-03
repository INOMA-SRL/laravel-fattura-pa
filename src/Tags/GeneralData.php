<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Type;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class GeneralData extends Tag {
    use Makeable;

    private \Condividendo\FatturaPA\Tags\GeneralDocumentData $generalDocumentData;

    /**
     * @var array<\Condividendo\FatturaPA\Tags\DeliveryNoteDocument>
     */
    private ?array $deliveryNoteDocuments = null;

    public function __construct() {
        $this->generalDocumentData = GeneralDocumentData::make();
    }

    public function setType(Type $type): self {
        $this->generalDocumentData->setType($type);

        return $this;
    }

    public function setDate(Carbon $date): self {
        $this->generalDocumentData->setDate($date);

        return $this;
    }

    public function setCurrency(string $currency): self {
        $this->generalDocumentData->setCurrency($currency);

        return $this;
    }

    public function setDocumentAmount(BigDecimal $amount): self {
        $this->generalDocumentData->setDocumentAmount($amount);

        return $this;
    }

    public function setDocumentDescription(string $description): self {
        $this->generalDocumentData->setDocumentDescription($description);

        return $this;
    }

    public function setDocumentNumber(string $number): self {
        $this->generalDocumentData->setDocumentNumber($number);

        return $this;
    }

    public function setGeneralDocumentData(GeneralDocumentData $generalDocumentData): self {
        $this->generalDocumentData = $generalDocumentData;

        return $this;
    }

    /**
     * @param  array<\Condividendo\FatturaPA\Tags\DeliveryNoteDocument>  $deliveryNoteDocuments
     */
    public function setDeliveryNoteDocuments(array $deliveryNoteDocuments): self {
        $this->deliveryNoteDocuments = $deliveryNoteDocuments;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DatiGenerali');

        $e->appendChild($this->generalDocumentData->toDOMElement($dom));

        foreach ($this->deliveryNoteDocuments ?? [] as $deliveryNoteDocument) {
            $e->appendChild($deliveryNoteDocument->toDOMElement($dom));
        }

        return $e;
    }
}
