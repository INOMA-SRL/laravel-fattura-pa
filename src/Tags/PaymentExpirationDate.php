<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class PaymentExpirationDate extends Tag {
    use Makeable;

    private ?\Illuminate\Support\Carbon $date = null;

    public function setPaymentExpirationDate(Carbon $date): self {
        $this->date = $date;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('DataScadenzaPagamento', $this->date->toDateString());
    }
}
