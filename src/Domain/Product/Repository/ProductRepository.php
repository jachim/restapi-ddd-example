<?php
namespace App\Domain\Product\Repository;

use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\ProductId;
use Lib\Domain\DomainRepository;

interface ProductRepository extends DomainRepository
{
    public function findOneById(ProductId $productId) : ?Product;
}