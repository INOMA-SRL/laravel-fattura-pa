<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Fax extends Tag {
    use Makeable;

    private ?string $fax = null;

    public function setFax(string $fax): self {
        $this->fax = $fax;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('Fax', $this->fax);
    }
}
