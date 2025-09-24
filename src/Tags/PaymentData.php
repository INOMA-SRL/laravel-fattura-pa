<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\PaymentCondition as PaymentConditionEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentData extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\PaymentCondition $paymentCondition = null;

    private ?\Condividendo\FatturaPA\Tags\PaymentDetail $paymentDetail = null;

    public function setPaymentDetail(PaymentDetail $paymentDetail): self {
        $this->paymentDetail = $paymentDetail;

        return $this;
    }

    public function setPaymentCondition(PaymentConditionEnum $paymentCondition): self {
        $this->paymentCondition = PaymentCondition::make()->setPaymentCondition($paymentCondition);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DatiPagamento');

        $e->appendChild($this->paymentCondition->toDOMElement($dom));
        $e->appendChild($this->paymentDetail->toDOMElement($dom));

        return $e;
    }
}
