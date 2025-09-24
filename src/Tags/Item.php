<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
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

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DettaglioLinee');

        $e->appendChild($this->lineNumber->toDOMElement($dom));
        $e->appendChild($this->description->toDOMElement($dom));

        if ($this->quantity) {
            $e->appendChild($this->quantity->toDOMElement($dom));
        }

        $e->appendChild($this->unitPrice->toDOMElement($dom));
        $e->appendChild($this->totalPrice->toDOMElement($dom));
        $e->appendChild($this->vatTax->toDOMElement($dom));

        return $e;
    }
}
