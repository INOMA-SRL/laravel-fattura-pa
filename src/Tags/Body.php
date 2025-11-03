<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Type;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class Body extends Tag {
    use Makeable;

    private \Condividendo\FatturaPA\Tags\GeneralData $generalData;

    private \Condividendo\FatturaPA\Tags\GoodsServicesData $goodsServicesData;

    private ?\Condividendo\FatturaPA\Tags\PaymentData $paymentData = null;

    public function __construct() {
        $this->generalData = GeneralData::make();
        $this->goodsServicesData = GoodsServicesData::make();
    }

    public function setType(Type $type): self {
        $this->generalData->setType($type);

        return $this;
    }

    public function setCurrency(string $currency): self {
        $this->generalData->setCurrency($currency);

        return $this;
    }

    public function setDate(Carbon $date): self {
        $this->generalData->setDate($date);

        return $this;
    }

    public function setDocumentAmount(BigDecimal $amount): self {
        $this->generalData->setDocumentAmount($amount);

        return $this;
    }

    public function setDocumentDescription(string $description): self {
        $this->generalData->setDocumentDescription($description);

        return $this;
    }

    public function setNumber(string $number): self {
        $this->generalData->setDocumentNumber($number);

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Tags\Item>  $items
     */
    public function setItems(array $items): self {
        $this->goodsServicesData->setItems($items);

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Tags\SummaryItem>  $items
     */
    public function setSummaryItems(array $items): self {
        $this->goodsServicesData->setSummaryItems($items);

        return $this;
    }

    public function setGeneralData(GeneralData $generalData): self {
        $this->generalData = $generalData;

        return $this;
    }

    public function setGoodsServicesData(GoodsServicesData $gsData): self {
        $this->goodsServicesData = $gsData;

        return $this;
    }

    public function setPaymentData(PaymentData $paymentData): self {
        $this->paymentData = $paymentData;

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Tags\DeliveryNoteDocument>  $documents
     */
    public function setDeliveryNoteDocuments(array $documents): self {
        $this->generalData->setDeliveryNoteDocuments($documents);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('FatturaElettronicaBody');

        $e->appendChild($this->generalData->toDOMElement($dom));
        $e->appendChild($this->goodsServicesData->toDOMElement($dom));

        if ($this->paymentData) {
            $e->appendChild($this->paymentData->toDOMElement($dom));
        }

        return $e;
    }
}
