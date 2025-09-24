<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Condividendo\FatturaPA\Enums\Nature;
use Condividendo\FatturaPA\Enums\RegulatoryReference;
use Condividendo\FatturaPA\Enums\VatCollectionMode;
use Condividendo\FatturaPA\Tags\SummaryItem as SummaryItemTag;
use Condividendo\FatturaPA\Traits\Makeable;
use Condividendo\FatturaPA\Traits\UsesDecimal;
use RuntimeException;

class SummaryItem extends Entity {
    use Makeable;
    use UsesDecimal;

    /**
     * @var \Brick\Math\BigDecimal
     */
    private $taxRate;

    /**
     * @var \Brick\Math\BigDecimal
     */
    private $taxableAmount;

    /**
     * @var ?\Brick\Math\BigDecimal
     */
    private $taxAmount = null;

    /**
     * @var ?\Condividendo\FatturaPA\Enums\VatCollectionMode
     */
    private $vatCollectionMode;

    /**
     * @var ?\Condividendo\FatturaPA\Enums\Nature
     */
    private $nature;

    /**
     * @var ?\Condividendo\FatturaPA\Enums\RegulatoryReference
     */
    private $regulatoryReference;

    /**
     * @param  string|\Brick\Math\BigDecimal  $rate
     * @return $this
     */
    public function taxRate($rate): self {
        $this->taxRate = static::makeDecimal($rate);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $amount
     * @return $this
     */
    public function taxableAmount($amount): self {
        $this->taxableAmount = static::makeDecimal($amount);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $amount
     * @return $this
     */
    public function taxAmount($amount): self {
        $this->taxAmount = static::makeDecimal($amount);

        return $this;
    }

    public function nature(Nature $nature): self {
        $this->nature = $nature;

        return $this;
    }

    public function regulatoryReference(RegulatoryReference $ref): self {
        $this->regulatoryReference = $ref;

        return $this;
    }

    public function vatCollectionMode(VatCollectionMode $collectionMode): self {
        $this->vatCollectionMode = $collectionMode;

        return $this;
    }

    public function getTag(): SummaryItemTag {
        $tag = SummaryItemTag::make()
            ->setTaxRate($this->taxRate)
            ->setTaxableAmount($this->taxableAmount)
            ->setTaxAmount($this->taxAmount ?: $this->calculateTaxAmount());

        if ($this->vatCollectionMode) {
            $tag->setVatCollectionMode($this->vatCollectionMode);
        }

        if ($this->nature) {
            if (! $this->regulatoryReference) {
                throw new RuntimeException('Regulatory Reference must be set if Nature is provided');
            }

            $tag->setNature($this->nature);
            $tag->setRegulatoryReference($this->regulatoryReference);
        }

        return $tag;
    }

    private function calculateTaxAmount(): BigDecimal {
        return $this->taxableAmount->multipliedBy($this->taxRate)->toScale(2, RoundingMode::HALF_UP);
    }
}
