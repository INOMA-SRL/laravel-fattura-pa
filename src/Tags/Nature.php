<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\Nature as NatureEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Nature extends Tag {
    use Makeable;

    private NatureEnum|string|null $nature = null;

    public function setNature(NatureEnum|string $nature): self {
        $this->nature = $nature;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $value = match (true) {
            is_null($this->nature) => '',
            $this->nature instanceof NatureEnum => $this->nature->value,
            \is_string($this->nature) => $this->nature,
        };

        return $dom->createElement('Natura', $value);
    }
}
