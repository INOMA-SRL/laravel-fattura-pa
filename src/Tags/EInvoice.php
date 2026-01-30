<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\TransmissionFormat;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class EInvoice extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Enums\TransmissionFormat $format = null;

    private ?\Condividendo\FatturaPA\Tags\Header $header = null;

    /**
     * @var array<\Condividendo\FatturaPA\Tags\Body>
     */
    private array $bodies = [];

    public function setTransmissionFormat(TransmissionFormat $format): self {
        $this->format = $format;

        return $this;
    }

    public function setHeader(Header $header): self {
        $this->header = $header;

        return $this;
    }

    public function addBody(Body $body): self {
        $this->bodies[] = $body;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElementNS(
            'http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2',
            'p:FatturaElettronica'
        );

        $e->setAttribute('versione', $this->format->value);
        $e->appendChild($this->header->toDOMElement($dom));

        foreach ($this->bodies as $body) {
            $e->appendChild($body->toDOMElement($dom));
        }

        return $e;
    }
}
