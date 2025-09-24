<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Tags;

use Condividendo\FatturaPA\Traits\Makeable;
use DOMDocument;
use DOMElement;

class Address extends Tag {
    use Makeable;

    private ?\Condividendo\FatturaPA\Tags\AddressLine $addressLine = null;

    private ?\Condividendo\FatturaPA\Tags\StreetNumber $streetNumber = null;

    private ?\Condividendo\FatturaPA\Tags\City $city = null;

    private ?\Condividendo\FatturaPA\Tags\PostalCode $postalCode = null;

    private ?\Condividendo\FatturaPA\Tags\ProvinceOrState $provinceOrState = null;

    private ?\Condividendo\FatturaPA\Tags\Country $country = null;

    public function setAddressLine(string $addressLine): self {
        $this->addressLine = AddressLine::make()->setAddressLine($addressLine);

        return $this;
    }

    public function setStreetNumber(string $streetNumber): self {
        $this->streetNumber = StreetNumber::make()->setStreetNumber($streetNumber);

        return $this;
    }

    public function setCity(string $city): self {
        $this->city = City::make()->setCity($city);

        return $this;
    }

    public function setPostalCode(string $postalCode): self {
        $this->postalCode = PostalCode::make()->setPostalCode($postalCode);

        return $this;
    }

    public function setProvince(string $province): self {
        $this->provinceOrState = ProvinceOrState::make()->setProvinceOrState($province);

        return $this;
    }

    public function setCountry(string $country): self {
        $this->country = Country::make()->setCountry($country);

        return $this;
    }

    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function toDOMElement(DOMDocument $dom): DOMElement {
        $e = $dom->createElement('Sede');

        $e->appendChild($this->addressLine->toDOMElement($dom));

        if ($this->streetNumber) {
            $e->appendChild($this->streetNumber->toDOMElement($dom));
        }

        $e->appendChild($this->postalCode->toDOMElement($dom));
        $e->appendChild($this->city->toDOMElement($dom));
        $e->appendChild($this->provinceOrState->toDOMElement($dom));
        $e->appendChild($this->country->toDOMElement($dom));

        return $e;
    }
}
