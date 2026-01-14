<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Brick\Math\BigDecimal;
use Condividendo\FatturaPA\Enums\Type;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class GeneralDocumentData extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\DocumentType $type = null;

    private ?\Condividendo\FatturaPA\Tags\Currency $currency = null;

    private ?\Condividendo\FatturaPA\Tags\Date $date = null;

    private ?\Condividendo\FatturaPA\Tags\DocumentNumber $number = null;

    private ?\Condividendo\FatturaPA\Tags\DocumentAmount $amount = null;

    /**
     * @var DocumentDescription[]
     */
    private array $descriptions = [];

    public function setType(Type $type): self {
        $this->type = DocumentType::make()->setType($type);

        return $this;
    }

    public function setDate(Carbon $date): self {
        $this->date = Date::make()->setDate($date);

        return $this;
    }

    public function setCurrency(string $currency): self {
        $this->currency = Currency::make()->setCurrency($currency);

        return $this;
    }

    public function setDocumentAmount(BigDecimal $amount): self {
        $this->amount = DocumentAmount::make()->setDocumentAmount($amount);

        return $this;
    }

    /**
     * @param  string|string[]  $description
     */
    public function setDocumentDescription(string|array $description): self {
        $description = is_array($description) ? $description : [$description];

        $this->descriptions = array_map(fn ($desc) => DocumentDescription::make()->setDocumentDescription($desc), $description);

        return $this;
    }

    public function setDocumentNumber(string $number): self {
        $this->number = DocumentNumber::make()->setDocumentNumber($number);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('DatiGeneraliDocumento');

        $e->appendChild($this->type->toDOMElement($dom));
        $e->appendChild($this->currency->toDOMElement($dom));
        $e->appendChild($this->date->toDOMElement($dom));
        $e->appendChild($this->number->toDOMElement($dom));

        if ($this->amount) {
            $e->appendChild($this->amount->toDOMElement($dom));
        }

        if ($this->descriptions) {
            foreach ($this->descriptions as $description) {
                $e->appendChild($description->toDOMElement($dom));
            }
        }

        return $e;
    }
}
