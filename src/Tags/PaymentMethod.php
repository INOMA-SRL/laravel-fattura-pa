<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\PaymentMethod as PaymentMethodEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentMethod extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Enums\PaymentMethod $method = null;

    public function setPaymentMethod(PaymentMethodEnum $method): self {
        $this->method = $method;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('ModalitaPagamento', $this->method->value);
    }
}
