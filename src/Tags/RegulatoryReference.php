<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\RegulatoryReference as RegulatoryReferenceEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class RegulatoryReference extends Tag {
    use Makeable;

    private RegulatoryReferenceEnum|string|null $regulatoryReference = null;

    public function setRegulatoryReference(RegulatoryReferenceEnum|string $regulatoryReference): self {
        $this->regulatoryReference = $regulatoryReference;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $value = match (true) {
            is_null($this->regulatoryReference) => '',
            $this->regulatoryReference instanceof RegulatoryReferenceEnum => $this->regulatoryReference->value,
            \is_string($this->regulatoryReference) => $this->regulatoryReference,
        };

        return $dom->createElement('RiferimentoNormativo', $value);
    }
}
