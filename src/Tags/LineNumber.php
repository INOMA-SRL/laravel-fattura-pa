<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class LineNumber extends Tag {
    use Makeable;

    private ?string $number = null;

    public function setNumber(int $number): self {
        $this->number = "{$number}";

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('NumeroLinea', $this->number);
    }
}
