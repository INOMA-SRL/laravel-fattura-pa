<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class PaymentFinancialInstitute extends Tag {
    use Makeable;

    private ?string $financialInstitute = null;

    public function setFinancialInstitute(string $financialInstitute): self {
        $this->financialInstitute = $financialInstitute;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('IstitutoFinanziario', $this->financialInstitute);
    }
}
