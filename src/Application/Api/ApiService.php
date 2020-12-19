<?php


namespace App\Application\Api;


use App\Application\Api\Response\ApiResponse;
use App\Application\Api\Response\InvalidApiCallResponse;
use App\Application\Api\Response\SuccessApiResponse;
use App\Application\Command\AddProductCommand;
use Lib\CQRS\BaseCommand;
use Lib\CQRS\CommandBus;
use Lib\CQRS\CommandFactory;
use Lib\CQRS\CommandValidator;

class ApiService
{
    private array $endpoints;

    private CommandValidator $commandValidator;

    private CommandBus $commandBus;

    public function __construct(CommandValidator $commandValidator, CommandBus $commandBus)
    {
        $this->commandValidator = $commandValidator;
        $this->commandBus = $commandBus;
        $this->registerEndpoints();
    }

    private function registerEndpoints()
    {
        $this->registerEndpoint("/addProduct", AddProductCommand::class);
    }

    public function call(string $apiMethod, array $parameters) : ApiResponse
    {
        if(!$this->isEndpointExist($apiMethod)) {
            return new InvalidApiCallResponse("Endpoint $apiMethod does not exist.");
        }
        $commandClass = $this->resolveCommandClass($apiMethod);
        if(!$commandClass) {
            return new InvalidApiCallResponse("Endpoint $apiMethod is misconfigured.");
        }
        $command=CommandFactory::create($commandClass, $parameters);
        $commandValidationResult=$this->commandValidator->validateCommand($command);
        if(!$commandValidationResult->isValid()) {
            $errors=$commandValidationResult->getErrors();
            return new InvalidApiCallResponse("Wrong $parameters for endpoint $apiMethod", $errors);
        }

        try {
            $this->commandBus->handle($command);
            return new SuccessApiResponse();
        } catch (\Exception $ex) {
            return new InvalidApiCallResponse("Something went wrong", [$ex->getMessage()]);
        }

    }

    private function registerEndpoint(string $string, string $class)
    {
        $this->endpoints[] = new Endpoint($string, $class);
    }

    private function isEndpointExist(string $apiMethod)
    {
        foreach($this->endpoints as $endpoint) {
            if($endpoint->getApiMethod()===$apiMethod) return true;
        }
        return false;
    }

    private function resolveCommandClass(string $apiMethod) : ?string
    {
        foreach($this->endpoints as $endpoint) {
            if($endpoint->getApiMethod()===$apiMethod) return $endpoint->getCommandClass();
        }
        return null;
    }

}