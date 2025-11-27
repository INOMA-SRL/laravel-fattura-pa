<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Tags\OtherManagementData as OtherManagementDataTag;
use Condividendo\FatturaPA\Traits\Makeable;
use Condividendo\FatturaPA\Traits\UsesDecimal;
use Illuminate\Support\Carbon;

class OtherManagementData extends Entity {
    use Makeable;
    use UsesDecimal;

    private string $type;

    private ?string $textReference = null;

    private ?\Brick\Math\BigDecimal $numberReference = null;

    private ?Carbon $dateReference = null;

    public function type(string $type): self {
        $this->type = $type;

        return $this;
    }

    public function textReference(string $textReference): self {
        $this->textReference = $textReference;

        return $this;
    }

    public function numberReference(string|\Brick\Math\BigDecimal $numberReference): self {
        $this->numberReference = static::makeDecimal($numberReference);

        return $this;
    }

    public function dateReference(Carbon $dateReference): self {
        $this->dateReference = $dateReference;

        return $this;
    }

    public function getTag(): OtherManagementDataTag {
        return OtherManagementDataTag::make()
            ->setType($this->type)
            ->setTextReference($this->textReference)
            ->setNumberReference($this->numberReference)
            ->setDateReference($this->dateReference);
    }
}
