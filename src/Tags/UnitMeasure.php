<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class UnitMeasure extends Tag {
    use Makeable;

    private ?string $unitMeasure = null;

    public function setUnitMeasure(string $unitMeasure): self {
        $this->unitMeasure = $unitMeasure;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('UnitaMisura', $this->unitMeasure);
    }
}
