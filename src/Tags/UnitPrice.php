<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class UnitPrice extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $unitPrice = null;

    public function setUnitPrice(BigDecimal $unitPrice): self {
        static::checkScale($unitPrice, 2, 8);

        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('PrezzoUnitario', $this->unitPrice);
    }
}
