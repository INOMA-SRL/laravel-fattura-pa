<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\RegulatoryReference as RegulatoryReferenceEnum;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class RegulatoryReference extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Enums\RegulatoryReference $regulatoryReference = null;

    public function setRegulatoryReference(RegulatoryReferenceEnum $regulatoryReference): self {
        $this->regulatoryReference = $regulatoryReference;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('RiferimentoNormativo', $this->regulatoryReference->value);
    }
}
