<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class OtherManagementData extends Tag {
    use Makeable;

    private OtherManagementDataType $type;

    private OtherManagementDataTextReference $textReference;

    private OtherManagementDataNumberReference $numberReference;

    private OtherManagementDataDateReference $dateReference;

    public function setType(string $type): self {
        $this->type = OtherManagementDataType::make()->setType($type);

        return $this;
    }

    public function setTextReference(?string $textReference): self {
        $this->textReference = OtherManagementDataTextReference::make()->setTextReference($textReference);

        return $this;
    }

    public function setNumberReference(?\Brick\Math\BigDecimal $numberReference): self {
        $this->numberReference = OtherManagementDataNumberReference::make()->setNumberReference($numberReference);

        return $this;
    }

    public function setDateReference(?Carbon $dateReference): self {
        $this->dateReference = OtherManagementDataDateReference::make()->setDateReference($dateReference);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('AltriDatiGestionali');

        $e->appendChild($this->type->toDOMElement($dom));

        if ($this->textReference) {
            $e->appendChild($this->textReference->toDOMElement($dom));
        }

        if ($this->numberReference) {
            $e->appendChild($this->numberReference->toDOMElement($dom));
        }

        if ($this->dateReference) {
            $e->appendChild($this->dateReference->toDOMElement($dom));
        }

        return $e;
    }
}
