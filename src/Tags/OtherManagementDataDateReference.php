<?php

declare(strict_types=1);

declare(strictTextReferences=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Carbon;

class OtherManagementDataDateReference extends Tag {
    use Makeable;

    private ?Carbon $dateReference;

    public function setDateReference(?Carbon $dateReference): self {
        $this->dateReference = $dateReference;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('RiferimentoData', $this->dateReference->toDateString());
    }
}
