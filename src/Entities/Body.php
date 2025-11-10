<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Enums\PaymentCondition;
use Condividendo\FatturaPA\Enums\PaymentMethod;
use Condividendo\FatturaPA\Enums\Type;
use Condividendo\FatturaPA\Tags\Body as BodyTag;
use Condividendo\FatturaPA\Tags\PaymentData as PaymentDataTag;
use Condividendo\FatturaPA\Tags\PaymentDetail;
use Condividendo\FatturaPA\Traits\Makeable;
use Condividendo\FatturaPA\Traits\UsesDate;
use Condividendo\FatturaPA\Traits\UsesDecimal;
use Illuminate\Support\Carbon;
use RuntimeException;

class Body extends Entity {
    use Makeable;
    use UsesDate;
    use UsesDecimal;

    private ?\Condividendo\FatturaPA\Enums\Type $type = null;

    private ?string $currency = null;

    private ?\Illuminate\Support\Carbon $date = null;

    private ?\Brick\Math\BigDecimal $amount = null;

    private ?string $description = null;

    private ?string $number = null;

    private ?\Condividendo\FatturaPA\Enums\PaymentCondition $paymentCondition = null;

    private ?\Condividendo\FatturaPA\Enums\PaymentMethod $paymentMethod = null;

    private ?\Illuminate\Support\Carbon $paymentExpirationDate = null;

    private ?\Brick\Math\BigDecimal $paymentAmount = null;

    private ?string $financialInstitute = null;

    private ?string $abi = null;

    private ?string $cab = null;

    /**
     * @var array<\Condividendo\FatturaPA\Entities\Item>
     */
    private ?array $items = null;

    /**
     * @var array<\Condividendo\FatturaPA\Entities\DeliveryNoteDocument>
     */
    private ?array $deliveryNoteDocuments = null;

    /**
     * @var array<\Condividendo\FatturaPA\Entities\SummaryItem>
     */
    private ?array $summaryItems = null;

    public function type(Type $type): self {
        $this->type = $type;

        return $this;
    }

    public function currency(string $currency): self {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param  string|\Illuminate\Support\Carbon  $date
     * @return $this
     */
    public function date($date): self {
        $this->date = static::makeDate($date);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $amount
     * @return $this
     */
    public function documentAmount($amount): self {
        $this->amount = static::makeDecimal($amount);

        return $this;
    }

    public function documentDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    public function number(string $number): self {
        $this->number = $number;

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Entities\Item>  $items
     */
    public function items(array $items): self {
        $this->items = $items;

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Entities\SummaryItem>  $items
     */
    public function summaryItems(array $items): self {
        $this->summaryItems = $items;

        return $this;
    }

    public function paymentMethod(PaymentMethod $paymentMethod): self {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param  string|\Illuminate\Support\Carbon  $date
     * @return $this
     */
    public function paymentExpirationDate($date): self {
        $this->paymentExpirationDate = static::makeDate($date);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $amount
     * @return $this
     */
    public function paymentAmount($amount): self {
        $this->paymentAmount = static::makeDecimal($amount);

        return $this;
    }

    public function paymentCondition(PaymentCondition $paymentCondition): self {
        $this->paymentCondition = $paymentCondition;

        return $this;
    }

    public function paymentFinancialInstitute(string $financialInstitute): self {
        $this->financialInstitute = $financialInstitute;

        return $this;
    }

    public function paymentAbi(string $abi): self {
        $this->abi = $abi;

        return $this;
    }

    public function paymentCab(string $cab): self {
        $this->cab = $cab;

        return $this;
    }

    /**
     * @param  array<int, \Condividendo\FatturaPA\Entities\DeliveryNoteDocument>  $documents
     */
    public function deliveryNoteDocuments(array $documents): self {
        $this->deliveryNoteDocuments = $documents;

        return $this;
    }

    public function getTag(): BodyTag {
        $items = [];
        $summaryItems = [];
        $deliveryNoteDocuments = [];

        foreach ($this->items as $item) {
            $items[] = $item->getTag();
        }

        foreach ($this->summaryItems as $item) {
            $summaryItems[] = $item->getTag();
        }

        foreach ($this->deliveryNoteDocuments ?? [] as $document) {
            $deliveryNoteDocuments[] = $document->getTag();
        }

        $body = BodyTag::make()
            ->setType($this->type)
            ->setCurrency($this->currency)
            ->setDate($this->date ?: Carbon::today())
            ->setNumber($this->number)
            ->setItems($items)
            ->setSummaryItems($summaryItems);

        if ($this->amount) {
            $body->setDocumentAmount($this->amount);
        }

        if ($this->description) {
            $body->setDocumentDescription($this->description);
        }

        $paymentData = $this->getPaymentDataTag();

        if ($paymentData) {
            $body->setPaymentData($paymentData);
        }

        if ($deliveryNoteDocuments) {
            $body->setDeliveryNoteDocuments($deliveryNoteDocuments);
        }

        return $body;
    }

    private function getPaymentDataTag(): ?PaymentDataTag {
        if (! $this->paymentCondition) {
            return null;
        }

        if (! $this->paymentMethod || ! $this->paymentAmount) {
            throw new RuntimeException("'paymentMethod' and 'paymentAmount' cannot be null!");
        }

        $detail = PaymentDetail::make()
            ->setPaymentMethod($this->paymentMethod)
            ->setPaymentAmount($this->paymentAmount);

        if ($this->paymentExpirationDate) {
            $detail->setPaymentExpirationDate($this->paymentExpirationDate);
        }

        if ($this->financialInstitute) {
            $detail->setFinancialInstitute($this->financialInstitute);
        }

        if ($this->abi) {
            $detail->setAbi($this->abi);
        }

        if ($this->cab) {
            $detail->setCab($this->cab);
        }

        return PaymentDataTag::make()
            ->setPaymentCondition($this->paymentCondition)
            ->setPaymentDetail($detail);
    }
}
