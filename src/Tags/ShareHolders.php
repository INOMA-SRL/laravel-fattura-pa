<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\ShareHolder;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class ShareHolders extends Tag {
    use Makeable;

    private ?ShareHolder $shareHolders = null;

    public function setShareHolders(ShareHolder $shareHolders): self {
        $this->shareHolders = $shareHolders;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        return $dom->createElement('SocioUnico', $this->shareHolders->value);
    }
}
