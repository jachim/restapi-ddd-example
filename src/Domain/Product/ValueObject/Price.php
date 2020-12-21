<?php
namespace App\Domain\Product\ValueObject;

use Lib\Domain\DomainException;
use Lib\Domain\ValueObject;

class Price extends ValueObject
{
    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function isEqual(Price $price) : bool
    {
        return $price->getAmount()===$this->getAmount() && $price->getCurrency()===$this->getCurrency();
    }

    public function isGreaterThanZero()
    {
        return $this->getAmount() > 0;
    }

    public function add(Price $price) : Price
    {
        if($price->getCurrency()!==$this->getCurrency()) {
            throw new DomainException("Currencies are not the same");
        }
        return new self($this->getAmount()+$price->getAmount(), $this->getCurrency());
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

}