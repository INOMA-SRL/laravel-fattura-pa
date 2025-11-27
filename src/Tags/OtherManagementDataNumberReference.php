<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class OtherManagementDataNumberReference extends Tag {
    use Makeable;

    private ?\Brick\Math\BigDecimal $numberReference;

    public function setNumberReference(?\Brick\Math\BigDecimal $numberReference): self {
        $this->numberReference = $numberReference;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('RiferimentoNumero', $this->numberReference);
    }
}
