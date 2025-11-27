<?php

declare(strict_types=1);

declare(strictTextReferences=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class OtherManagementDataTextReference extends Tag {
    use Makeable;

    private ?string $textReference;

    public function setTextReference(?string $textReference): self {
        $this->textReference = $textReference;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('RiferimentoTesto', $this->textReference);
    }
}
