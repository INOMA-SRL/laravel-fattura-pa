<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Nature;
use Condividendo\FatturaPA\Tags\Item as ItemTag;
use Condividendo\FatturaPA\Traits\Makeable;
use Condividendo\FatturaPA\Traits\UsesDecimal;

class Item extends Entity {
    use Makeable;
    use UsesDecimal;

    private ?int $lineNumber = null;

    private ?string $description = null;

    private ?\Brick\Math\BigDecimal $quantity = null;

    private ?\Brick\Math\BigDecimal $unitPrice = null;

    private ?\Brick\Math\BigDecimal $totalPrice = null;

    private ?\Brick\Math\BigDecimal $taxRate = null;

    private ?string $unitMeasure = null;

    /**
     * @var array<\Condividendo\FatturaPA\Entities\ArticleCode>
     */
    private ?array $articleCodes = null;

    /**
     * @var array<\Condividendo\FatturaPA\Entities\OtherManagementData>
     */
    private ?array $otherManagementData = null;

    private \Condividendo\FatturaPA\Enums\Nature|string|null $nature = null;

    public function number(int $lineNumber): self {
        $this->lineNumber = $lineNumber;

        return $this;
    }

    public function description(string $description): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $quantity
     * @return $this
     */
    public function quantity($quantity): self {
        $this->quantity = static::makeDecimal($quantity);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $unitPrice
     * @return $this
     */
    public function price($unitPrice): self {
        $this->unitPrice = static::makeDecimal($unitPrice);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $totalPrice
     * @return $this
     */
    public function totalAmount($totalPrice): self {
        $this->totalPrice = static::makeDecimal($totalPrice);

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $rate
     * @return $this
     */
    public function taxRate($rate): self {
        $this->taxRate = static::makeDecimal($rate);

        return $this;
    }

    public function unitMeasure(string $unitMeasure): self {
        $this->unitMeasure = $unitMeasure;

        return $this;
    }

    /**
     * @param  array<\Condividendo\FatturaPA\Entities\ArticleCode>  $articleCodes
     */
    public function articleCodes(array $articleCodes): self {
        $this->articleCodes = $articleCodes;

        return $this;
    }

    /**
     * @param  array<\Condividendo\FatturaPA\Entities\OtherManagementData>  $otherManagementData
     */
    public function otherManagementData(array $otherManagementData): self {
        $this->otherManagementData = $otherManagementData;

        return $this;
    }

    public function nature(Nature|string $nature): self {
        $this->nature = $nature;

        return $this;
    }

    public function getTag(): ItemTag {
        $tag = ItemTag::make()
            ->setLineNumber($this->lineNumber)
            ->setDescription($this->description)
            ->setTaxRate($this->taxRate)
            ->setUnitPrice($this->unitPrice)
            ->setTotalAmount($this->totalPrice ?: $this->calculateTotalAmount());

        if ($this->quantity) {
            $tag->setQuantity($this->quantity);
        }

        if ($this->unitMeasure) {
            $tag->setUnitMeasure($this->unitMeasure);
        }

        if ($this->articleCodes) {
            $tag->setArticleCodes(array_map(fn (\Condividendo\FatturaPA\Entities\ArticleCode $code) => $code->getTag(), $this->articleCodes));
        }

        if ($this->otherManagementData) {
            $tag->setOtherManagementData(array_map(fn (\Condividendo\FatturaPA\Entities\OtherManagementData $otherManagementData) => $otherManagementData->getTag(), $this->otherManagementData));
        }

        if ($this->nature) {
            $tag->setNature($this->nature);
        }

        return $tag;
    }

    private function calculateTotalAmount(): BigDecimal {
        return $this->quantity
            ? $this->unitPrice->multipliedBy($this->quantity)
            : $this->unitPrice;
    }
}
