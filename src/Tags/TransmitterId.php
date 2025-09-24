<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class TransmitterId extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\CountryId $countryId = null;

    private ?\Condividendo\FatturaPA\Tags\CodeId $codeId = null;

    public function setCountryId(CountryId $id): self {
        $this->countryId = $id;

        return $this;
    }

    public function setCodeId(CodeId $id): self {
        $this->codeId = $id;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('IdTrasmittente');

        $e->appendChild($this->countryId->toDOMElement($dom));
        $e->appendChild($this->codeId->toDOMElement($dom));

        return $e;
    }
}
