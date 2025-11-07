<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\PaymentMethod as PaymentMethodEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class PaymentDetail extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\PaymentMethod $paymentMethod = null;

    private ?\Condividendo\FatturaPA\Tags\PaymentExpirationDate $paymentExpirationDate = null;

    private ?\Condividendo\FatturaPA\Tags\PaymentAmount $amount = null;

    private ?\Condividendo\FatturaPA\Tags\PaymentFinancialInstitute $financialInstitute = null;

    public function setPaymentMethod(PaymentMethodEnum $paymentMethod): self {
        $this->paymentMethod = PaymentMethod::make()->setPaymentMethod($paymentMethod);

        return $this;
    }

    public function setPaymentExpirationDate(Carbon $date): self {
        $this->paymentExpirationDate = PaymentExpirationDate::make()->setPaymentExpirationDate($date);

        return $this;
    }

    public function setPaymentAmount(BigDecimal $amount): self {
        $this->amount = PaymentAmount::make()->setAmount($amount);

        return $this;
    }

    public function setFinancialInstitute(string $financialInstitute): self {
        $this->financialInstitute = PaymentFinancialInstitute::make()->setFinancialInstitute($financialInstitute);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DettaglioPagamento');

        $e->appendChild($this->paymentMethod->toDOMElement($dom));

        if ($this->paymentExpirationDate) {
            $e->appendChild($this->paymentExpirationDate->toDOMElement($dom));
        }

        $e->appendChild($this->amount->toDOMElement($dom));

        if ($this->financialInstitute) {
            $e->appendChild($this->financialInstitute->toDOMElement($dom));
        }

        return $e;
    }
}
