<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ShareHolders extends Tag {
    use Makeable;

    private ?string $shareHolders = null;

    public function setShareHolders(string $shareHolders): self {
        $this->shareHolders = $shareHolders;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('SocioUnico', $this->shareHolders);
    }
}
