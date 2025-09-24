<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class DocumentDescription extends Tag {
    use Makeable;

    private ?string $description = null;

    public function setDocumentDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('Causale', $this->description);
    }
}
