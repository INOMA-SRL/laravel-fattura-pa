<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class OtherManagementDataType extends Tag {
    use Makeable;

    private string $type;

    public function setType(string $type): self {
        $this->type = $type;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('TipoDato', $this->type);
    }
}
