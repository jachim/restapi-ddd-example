<?php
namespace App\Domain\Product\Event;

use App\Domain\Product\ValueObject\Price;
use Lib\Domain\DomainEvent;

class ProductAddedEvent extends DomainEvent
{
    private string $productId;

    private string $name;

    private Price $price;

    public function __construct(string $productId, string $name, Price $price)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        parent::__construct();
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }


}