<?php

declare(strict_types=1);

namespace Condividendo\FatturaPA\Entities;

use Condividendo\FatturaPA\Enums\LiquidationStatus;
use Condividendo\FatturaPA\Enums\ShareHolder;
use Condividendo\FatturaPA\Enums\TaxRegime;
use Condividendo\FatturaPA\Tags\Contacts as ContactsTag;
use Condividendo\FatturaPA\Tags\REARegistration as REARegistrationTag;
use Condividendo\FatturaPA\Tags\Supplier as SupplierTag;
use Condividendo\FatturaPA\Traits\HasVatNumber;
use Condividendo\FatturaPA\Traits\Makeable;
use Condividendo\FatturaPA\Traits\UsesDecimal;
use RuntimeException;

class Supplier extends Entity {
    use HasVatNumber;
    use Makeable;
    use UsesDecimal;

    private ?string $companyName = null;

    private ?string $fiscalCode = null;

    private ?string $vatCountryId = null;

    private ?string $vatNumber = null;

    private ?\Condividendo\FatturaPA\Enums\TaxRegime $taxRegime = null;

    private ?string $reaOfficeCode = null;

    private ?string $reaNumber = null;

    private ?\Brick\Math\BigDecimal $reaCapital = null;

    private ?\Condividendo\FatturaPA\Enums\ShareHolder $reaShareHolders = null;

    private ?\Condividendo\FatturaPA\Enums\LiquidationStatus $reaLiquidationStatus = null;

    private ?\Condividendo\FatturaPA\Entities\Address $address = null;

    private ?string $contactsEmail = null;

    private ?string $contactsFax = null;

    private ?string $contactsPhoneNumber = null;

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

    public function taxRegime(TaxRegime $taxRegime): self {
        $this->taxRegime = $taxRegime;

        return $this;
    }

    public function REAOfficeCode(string $officeCode): self {
        $this->reaOfficeCode = $officeCode;

        return $this;
    }

    public function REANumber(string $reaNumber): self {
        $this->reaNumber = $reaNumber;

        return $this;
    }

    /**
     * @param  string|\Brick\Math\BigDecimal  $capital
     * @return $this
     */
    public function REACapital($capital): self {
        $this->reaCapital = static::makeDecimal($capital);

        return $this;
    }

    public function REAShareHolders(ShareHolder $shareHolders): self {
        $this->reaShareHolders = $shareHolders;

        return $this;
    }

    public function REALiquidationStatus(LiquidationStatus $liquidationStatus): self {
        $this->reaLiquidationStatus = $liquidationStatus;

        return $this;
    }

    public function address(Address $address): self {
        $this->address = $address;

        return $this;
    }

    public function contactsEmail(string $email): self {
        $this->contactsEmail = $email;

        return $this;
    }

    public function contactsFax(string $fax): self {
        $this->contactsFax = $fax;

        return $this;
    }

    public function contactsPhoneNumber(string $number): self {
        $this->contactsPhoneNumber = $number;

        return $this;
    }

    public function getTag(): SupplierTag {
        $tag = SupplierTag::make()
            ->setVatNumber($this->vatCountryId, $this->vatNumber)
            ->setTaxRegime($this->taxRegime)
            ->setCompanyName($this->companyName)
            ->setAddress($this->address->getTag());

        if ($this->fiscalCode) {
            $tag->setFiscalCode($this->fiscalCode);
        }

        $reaTag = $this->getREARegistrationTag();

        if ($reaTag) {
            $tag->setREARegistration($reaTag);
        }

        $contactsTag = $this->getContactsTag();

        if ($contactsTag) {
            $tag->setContacts($contactsTag);
        }

        return $tag;
    }

    public function getREARegistrationTag(): ?REARegistrationTag {
        if (! $this->reaOfficeCode) {
            return null;
        }

        if (! $this->reaNumber || ! $this->reaLiquidationStatus) {
            throw new RuntimeException("'reaNumber' and 'reaLiquidationStatus' cannot be null!");
        }

        $tag = REARegistrationTag::make()
            ->setOfficeCode($this->reaOfficeCode)
            ->setREANumber($this->reaNumber)
            ->setLiquidationStatus($this->reaLiquidationStatus);

        if ($this->reaCapital) {
            $tag->setCapital($this->reaCapital);
        }

        if ($this->reaShareHolders) {
            $tag->setShareHolders($this->reaShareHolders);
        }

        return $tag;
    }

    public function getContactsTag(): ?ContactsTag {
        if (! $this->contactsEmail && ! $this->contactsFax && ! $this->contactsPhoneNumber) {
            return null;
        }

        $tag = ContactsTag::make();

        if ($this->contactsEmail) {
            $tag->setEmail($this->contactsEmail);
        }

        if ($this->contactsFax) {
            $tag->setFax($this->contactsFax);
        }

        if ($this->contactsPhoneNumber) {
            $tag->setPhone($this->contactsPhoneNumber);
        }

        return $tag;
    }
}
