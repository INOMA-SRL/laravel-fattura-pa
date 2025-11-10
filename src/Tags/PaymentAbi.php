<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentAbi extends Tag {
    use Makeable;

    private ?string $abi = null;

    public function setAbi(string $abi): self {
        $this->abi = $abi;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('ABI', $this->abi);
    }
}
