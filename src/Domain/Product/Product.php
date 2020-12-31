<?php
namespace App\Domain\Product;

use App\Domain\Product\Event\ProductAddedEvent;
use App\Domain\Product\Event\ProductPriceChangedEvent;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductId;
use Lib\Domain\Aggregate;
use Lib\Domain\DomainException;

class Product extends Aggregate
{
    private ProductId $productId;

    private string $name;

    private Price $price;

    public function __construct(ProductId $productId, string $name, Price $price)
    {
        $this->validateName($name);
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->raise(new ProductAddedEvent($productId, $name, $price));
    }

    public function changePrice(Price $newPrice)
    {
        $oldPrice=clone $this->price;
        $this->price=$newPrice;
        $this->raise(new ProductPriceChangedEvent($newPrice, $oldPrice));
    }

    private function validateName(string $name)
    {
        if(!$name || strlen($name)>100) {
            throw new DomainException("Product name should not be empty, and the maxlength is 100.");
        }
    }
}