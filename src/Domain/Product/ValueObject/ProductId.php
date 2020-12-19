<?php
namespace App\Domain\Product\ValueObject;

use Lib\Domain\ValueObject;

class ProductId extends ValueObject
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function isEqual(ProductId $productId) : bool
    {
        return $this->id===$productId->getId();
    }

    public function getId(): string
    {
        return $this->id;
    }


}