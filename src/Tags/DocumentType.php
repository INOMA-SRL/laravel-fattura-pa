<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\Type;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DocumentType extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Enums\Type $type = null;

    public function setType(Type $type): self {
        $this->type = $type;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('TipoDocumento', $this->type->value);
    }
}
