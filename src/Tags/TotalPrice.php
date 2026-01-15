<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class TotalPrice extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $totalPrice = null;

    public function setTotalPrice(BigDecimal $totalPrice): self {
        static::checkScale($totalPrice, 2, 8);

        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('PrezzoTotale', $this->totalPrice->__toString());
    }
}
