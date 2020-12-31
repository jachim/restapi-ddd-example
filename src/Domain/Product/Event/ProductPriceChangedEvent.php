<?php
namespace App\Domain\Product\Event;

use App\Domain\Product\ValueObject\Price;
use Lib\Domain\DomainEvent;

class ProductPriceChangedEvent extends DomainEvent
{

    private Price $newPrice;

    private Price $oldPrice;

    public function __construct(Price $newPrice, Price $oldPrice)
    {
        $this->newPrice = $newPrice;
        $this->oldPrice = $oldPrice;
        parent::__construct();
    }

    public function getNewPrice(): Price
    {
        return $this->newPrice;
    }

    public function getOldPrice(): Price
    {
        return $this->oldPrice;
    }


}