<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Capital extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $capital = null;

    public function setCapital(BigDecimal $capital): self {
        static::checkScale($capital);

        $this->capital = $capital;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('CapitaleSociale', $this->capital);
    }
}
