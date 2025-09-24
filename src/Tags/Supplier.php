<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Enums\TaxRegime;
use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Supplier extends Tag {
    use Makeable;

    private \Condividendo\FatturaPA\Tags\TaxableEntity $taxableEntity;

    private ?\Condividendo\FatturaPA\Tags\Address $address = null;

    private ?\Condividendo\FatturaPA\Tags\REARegistration $reaRegistration = null;

    private ?\Condividendo\FatturaPA\Tags\Contacts $contacts = null;

    public function __construct() {
        $this->taxableEntity = TaxableEntity::make();
    }

    public function setName(string $name): self {
        return $this->setCompanyName($name);
    }

    public function setCompanyName(string $name): self {
        $this->taxableEntity->setCompanyName($name);

        return $this;
    }

    public function setVatNumber(string $countryCode, string $vatNumber): self {
        $this->taxableEntity->setVatNumber($countryCode, $vatNumber);

        return $this;
    }

    public function setFiscalCode(string $code): self {
        $this->taxableEntity->setFiscalCode($code);

        return $this;
    }

    public function setTaxRegime(TaxRegime $taxRegime): self {
        $this->taxableEntity->setTaxRegime($taxRegime);

        return $this;
    }

    public function setTaxableEntity(TaxableEntity $taxableEntity): self {
        $this->taxableEntity = $taxableEntity;

        return $this;
    }

    public function setAddress(Address $address): self {
        $this->address = $address;

        return $this;
    }

    public function setReaRegistration(REARegistration $reaRegistration): self {
        $this->reaRegistration = $reaRegistration;

        return $this;
    }

    public function setContacts(Contacts $contacts): self {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('CedentePrestatore');

        $e->appendChild($this->taxableEntity->toDOMElement($dom));
        $e->appendChild($this->address->toDOMElement($dom));

        if ($this->reaRegistration) {
            $e->appendChild($this->reaRegistration->toDOMElement($dom));
        }

        if ($this->contacts) {
            $e->appendChild($this->contacts->toDOMElement($dom));
        }

        return $e;
    }
}
