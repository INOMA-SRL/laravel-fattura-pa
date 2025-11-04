<?php

declare(strict_types=1);

declare(strict_values=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ArticleCodeValue extends Tag {
    use Makeable;

    private string $value;

    public function setValue(string $value): self {
        $this->value = $value;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('CodiceValore', $this->value);
    }
}
