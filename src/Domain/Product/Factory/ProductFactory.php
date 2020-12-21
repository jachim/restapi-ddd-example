<?php
namespace App\Domain\Product\Factory;

use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductId;
use Lib\Domain\DomainException;
use Lib\Domain\UUIDGenerator;

class ProductFactory
{
    public function createProduct(string $name, float $amount, string $currency) : Product
    {
        $uuid = UUIDGenerator::generate();
        $productId = new ProductId($uuid);
        $price = new Price($amount, $currency);
        $this->validateName($name);
        $this->validatePrice($price);
        $product = new Product($productId, $name, $price);
        return $product;
    }

    private function validateName(string $name)
    {
        if(!$name || strlen($name)>100) {
            throw new DomainException("Product name should not be empty, and the maxlength is 100.");
        }
    }

    private function validatePrice(Price $price)
    {
        if(!$price->isGreaterThanZero()) {
            throw new DomainException("Price must be greate than zero.");
        }
    }
}