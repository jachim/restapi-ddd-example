<?php
namespace App\Domain\Product\Factory;

use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\Price;
use Lib\Domain\UUIDGenerator;

class ProductFactory
{
    public function createProduct(string $name, float $amount, string $currency) : Product
    {
        $productId = UUIDGenerator::generate();
        $product = new Product($productId, $name, new Price($amount, $currency));
        return $product;
    }
}