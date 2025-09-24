<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Duty extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $duty = null;

    public function setDuty(BigDecimal $duty): self {
        static::checkScale($duty);

        $this->duty = $duty;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('Imposta', $this->duty);
    }
}
