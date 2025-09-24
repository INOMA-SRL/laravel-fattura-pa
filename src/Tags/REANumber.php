<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class REANumber extends Tag {
    use Makeable;

    private ?string $number = null;

    public function setREANumber(string $number): self {
        $this->number = $number;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('NumeroREA', $this->number);
    }
}
