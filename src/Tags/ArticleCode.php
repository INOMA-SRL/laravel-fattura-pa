<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ArticleCode extends Tag {
    use Makeable;

    private ArticleCodeType $type;

    private ArticleCodeValue $value;

    public function setType(string $type): self {
        $this->type = ArticleCodeType::make()->setType($type);

        return $this;
    }

    public function setValue(string $value): self {
        $this->value = ArticleCodeValue::make()->setValue($value);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('CodiceArticolo');

        $e->appendChild($this->type->toDOMElement($dom));
        $e->appendChild($this->value->toDOMElement($dom));

        return $e;
    }
}
