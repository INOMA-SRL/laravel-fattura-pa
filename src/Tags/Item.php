<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Nature as NatureEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Item extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\LineNumber $lineNumber = null;

    private ?\Condividendo\FatturaPA\Tags\Description $description = null;

    private ?\Condividendo\FatturaPA\Tags\Quantity $quantity = null;

    private ?\Condividendo\FatturaPA\Tags\UnitPrice $unitPrice = null;

    private ?\Condividendo\FatturaPA\Tags\TotalPrice $totalPrice = null;

    private ?\Condividendo\FatturaPA\Tags\VatTax $vatTax = null;

    private ?\Condividendo\FatturaPA\Tags\UnitMeasure $unitMeasure = null;

    private ?\Condividendo\FatturaPA\Tags\Nature $nature = null;

    /**
     * @var array<\Condividendo\FatturaPA\Tags\ArticleCode>
     */
    private ?array $articleCodes = null;

    /**
     * @var array<\Condividendo\FatturaPA\Tags\OtherManagementData>
     */
    private ?array $otherManagementData = null;

    public function setLineNumber(int $lineNumber): self {
        $this->lineNumber = LineNumber::make()->setNumber($lineNumber);

        return $this;
    }

    public function setDescription(string $description): self {
        $this->description = Description::make()->setDescription($description);

        return $this;
    }

    public function setQuantity(BigDecimal $quantity): self {
        $this->quantity = Quantity::make()->setQuantity($quantity);

        return $this;
    }

    public function setUnitPrice(BigDecimal $unitPrice): self {
        $this->unitPrice = UnitPrice::make()->setUnitPrice($unitPrice);

        return $this;
    }

    public function setTotalAmount(BigDecimal $totalPrice): self {
        $this->totalPrice = TotalPrice::make()->setTotalPrice($totalPrice);

        return $this;
    }

    public function setTaxRate(BigDecimal $rate): self {
        $this->vatTax = VatTax::make()->setRate($rate);

        return $this;
    }

    public function setUnitMeasure(string $unitMeasure): self {
        $this->unitMeasure = UnitMeasure::make()->setUnitMeasure($unitMeasure);

        return $this;
    }

    /**
     * @param  array<\Condividendo\FatturaPA\Tags\ArticleCode>  $articleCodes
     */
    public function setArticleCodes(array $articleCodes): self {
        $this->articleCodes = $articleCodes;

        return $this;
    }

    /**
     * @param  array<\Condividendo\FatturaPA\Tags\OtherManagementData>  $otherManagementData
     */
    public function setOtherManagementData(array $otherManagementData): self {
        $this->otherManagementData = $otherManagementData;

        return $this;
    }

    public function setNature(NatureEnum|string $nature): self {
        $this->nature = Nature::make()->setNature($nature);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DettaglioLinee');

        $e->appendChild($this->lineNumber->toDOMElement($dom));

        foreach ($this->articleCodes ?? [] as $articleCode) {
            $e->appendChild($articleCode->toDOMElement($dom));
        }

        $e->appendChild($this->description->toDOMElement($dom));

        if ($this->quantity) {
            $e->appendChild($this->quantity->toDOMElement($dom));
        }

        if ($this->unitMeasure) {
            $e->appendChild($this->unitMeasure->toDOMElement($dom));
        }

        foreach ($this->otherManagementData ?? [] as $otherManagementData) {
            $e->appendChild($otherManagementData->toDOMElement($dom));
        }

        $e->appendChild($this->unitPrice->toDOMElement($dom));
        $e->appendChild($this->totalPrice->toDOMElement($dom));
        $e->appendChild($this->vatTax->toDOMElement($dom));

        if ($this->nature) {
            $e->appendChild($this->nature->toDOMElement($dom));
        }

        return $e;
    }
}
