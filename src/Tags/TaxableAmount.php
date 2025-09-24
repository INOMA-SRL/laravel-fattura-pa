<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class TaxableAmount extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $amount = null;

    public function setAmount(BigDecimal $amount): self {
        static::checkScale($amount);

        $this->amount = $amount;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('ImponibileImporto', $this->amount);
    }
}
