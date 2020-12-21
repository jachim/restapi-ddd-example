<?php
namespace App\Application\Handler;

use App\Application\Command\AddProductCommand;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductRepository;

class AddProductHandler
{
    private ProductFactory $productFactory;

    private ProductRepository $productRepository;

    public function __construct(ProductFactory $productFactory, ProductRepository $productRepository)
    {
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function addProduct(AddProductCommand $command)
    {
        $product = $this->productFactory->createProduct((string)$command->name, (float)$command->price, (string)$command->currency);
        $this->productRepository->save($product);
    }
}