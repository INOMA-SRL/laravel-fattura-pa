<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Enums\TaxRegime;
use Condividendo\FatturaPA\Tags\Customer as CustomerTag;
use Condividendo\FatturaPA\Traits\HasVatNumber;
use Condividendo\FatturaPA\Traits\Makeable;

class Customer extends Entity {
    use HasVatNumber;
    use Makeable;

    private ?string $companyName = null;

    private ?string $firstName = null;

    private ?string $lastName = null;

    private ?string $title = null;

    private ?string $fiscalCode = null;

    private ?string $vatCountryId = null;

    private ?string $vatNumber = null;

    private ?\Condividendo\FatturaPA\Enums\TaxRegime $taxRegime = null;

    private ?\Condividendo\FatturaPA\Entities\Address $address = null;

    public function companyName(string $companyName): self {
        $this->companyName = $companyName;

        return $this;
    }

    public function vatNumber(string $vatNumber, ?string $countryId = null): self {
        $this->vatCountryId = static::parseVatNumberCountryId($vatNumber, $countryId);
        $this->vatNumber = static::parseVatNumber($vatNumber, $countryId);

        return $this;
    }

    public function fiscalCode(string $fiscalCode): self {
        $this->fiscalCode = $fiscalCode;

        return $this;
    }

    public function title(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function firstName(string $firstName): self {
        $this->firstName = $firstName;

        return $this;
    }

    public function lastName(string $lastName): self {
        $this->lastName = $lastName;

        return $this;
    }

    public function taxRegime(TaxRegime $taxRegime): self {
        $this->taxRegime = $taxRegime;

        return $this;
    }

    public function address(Address $address): self {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): Address {
        return $this->address;
    }

    public function getTag(): CustomerTag {
        $tag = CustomerTag::make()
            ->setAddress($this->address->getTag());

        if ($this->taxRegime) {
            $tag->setTaxRegime($this->taxRegime);
        }

        if ($this->companyName) {
            $tag->setCompanyName($this->companyName);
        }

        if ($this->firstName) {
            $tag->setFirstName($this->firstName);
        }

        if ($this->lastName) {
            $tag->setLastName($this->lastName);
        }

        if ($this->title) {
            $tag->setTitle($this->title);
        }

        if ($this->fiscalCode) {
            $tag->setFiscalCode($this->fiscalCode);
        }

        if ($this->vatCountryId && $this->vatNumber) {
            $tag->setVatNumber($this->vatCountryId, $this->vatNumber);
        }

        return $tag;
    }
}
