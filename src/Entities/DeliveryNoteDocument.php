<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Tags\DeliveryNoteDocument as DeliveryNoteDocumentTag;
use Condividendo\FatturaPA\Traits\Makeable;
use DateTimeInterface;

class DeliveryNoteDocument extends Entity {
    use Makeable;

    private ?string $number = null;

    private ?\Illuminate\Support\Carbon $date = null;

    private ?int $lineNumber = null;

    public function number(string $number): self {
        $this->number = $number;

        return $this;
    }

    public function taxableAmount(DateTimeInterface|string $date): self {
        $this->date = \Illuminate\Support\Carbon::parse($date);

        return $this;
    }

    public function lineNumber(int $number): self {
        $this->lineNumber = $number;

        return $this;
    }

    public function getTag(): DeliveryNoteDocumentTag {
        $tag = DeliveryNoteDocumentTag::make();

        if ($this->number) {
            $tag->setNumber($this->number);
        }

        if ($this->date) {
            $tag->setDate($this->date);
        }

        if ($this->lineNumber) {
            $tag->setLineNumber($this->lineNumber);
        }

        return $tag;
    }
}
