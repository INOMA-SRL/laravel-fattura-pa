<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Nature as NatureEnum;
use Condividendo\FatturaPA\Enums\RegulatoryReference as RegulatoryReferenceEnum;
use Condividendo\FatturaPA\Enums\VatCollectionMode as VatCollectionModeEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class SummaryItem extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\VatTax $vatTax = null;

    private ?\Condividendo\FatturaPA\Tags\TaxableAmount $taxableAmount = null;

    private ?\Condividendo\FatturaPA\Tags\Duty $duty = null;

    private ?\Condividendo\FatturaPA\Tags\VatCollectionMode $vatCollectionMode = null;

    private ?\Condividendo\FatturaPA\Tags\Nature $nature = null;

    private ?\Condividendo\FatturaPA\Tags\RegulatoryReference $regulatoryReference = null;

    public function setTaxRate(BigDecimal $rate): self {
        $this->vatTax = VatTax::make()->setRate($rate);

        return $this;
    }

    public function setTaxableAmount(BigDecimal $amount): self {
        $this->taxableAmount = TaxableAmount::make()->setAmount($amount);

        return $this;
    }

    public function setTaxAmount(BigDecimal $amount): self {
        $this->duty = Duty::make()->setDuty($amount);

        return $this;
    }

    public function setNature(NatureEnum|string $nature): self {
        $this->nature = Nature::make()->setNature($nature);

        return $this;
    }

    public function setRegulatoryReference(RegulatoryReferenceEnum|string $ref): self {
        $this->regulatoryReference = RegulatoryReference::make()->setRegulatoryReference($ref);

        return $this;
    }

    public function setVatCollectionMode(VatCollectionModeEnum $collectionMode): self {
        $this->vatCollectionMode = VatCollectionMode::make()->setVatCollectionMode($collectionMode);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DatiRiepilogo');

        $e->appendChild($this->vatTax->toDOMElement($dom));

        if ($this->nature) {
            $e->appendChild($this->nature->toDOMElement($dom));
        }

        $e->appendChild($this->taxableAmount->toDOMElement($dom));
        $e->appendChild($this->duty->toDOMElement($dom));

        if ($this->vatCollectionMode) {
            $e->appendChild($this->vatCollectionMode->toDOMElement($dom));
        }

        if ($this->regulatoryReference) {
            $e->appendChild($this->regulatoryReference->toDOMElement($dom));
        }

        return $e;
    }
}
