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
        $product = new Product($productId, $name, $price);
        return $product;
    }
}