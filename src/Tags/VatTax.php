<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class VatTax extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $percentage = null;

    public function setRate(BigDecimal $percentage): self {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('AliquotaIVA', $this->percentage->__toString());
    }
}
