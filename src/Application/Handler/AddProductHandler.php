<?php


namespace App\Application\Handler;


use App\Application\Command\AddProductCommand;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductRepository;
use Lib\CQRS\CommandValidator;

class AddProductHandler
{
    private CommandValidator $commandValidator;

    private ProductFactory $productFactory;

    private ProductRepository $productRepository;

    public function __construct(CommandValidator $commandValidator, ProductFactory $productFactory, ProductRepository $productRepository)
    {
        $this->commandValidator = $commandValidator;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
    }

    public function createProduct(AddProductCommand $command)
    {
        $commandValidatonResult=$this->commandValidator->validateCommand($command);
        if(!$commandValidatonResult->isValid()) {
            $errors = implode(", ", $commandValidatonResult->getErrors());
            throw new \Exception("Command is not valid. \n". $errors);
        }
        $product=$this->productFactory->createProduct((string)$command->name, (float)$command->priceAmount, (string)$command->priceCurrency);
        $this->productRepository->save($product);
    }
}