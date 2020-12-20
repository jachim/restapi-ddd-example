<?php
namespace App\Application\Api;

use App\Application\Api\Response\ApiResponse;
use App\Application\Api\Response\InvalidApiCallResponse;
use App\Application\Api\Response\SuccessApiResponse;
use App\Application\Command\AddProductCommand;
use Lib\CQRS\CommandBus;
use Lib\CQRS\CommandFactory;

class ApiService
{
    private array $endpoints=[];

    private CommandBus $commandBus;

    private CommandFactory $commandFactory;

    public function __construct(CommandFactory $commandFactory, CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->commandFactory = $commandFactory;
        $this->registerEndpoints();
    }

    private function registerEndpoints()
    {
        /* this mapping could be in config file */
        $this->registerEndpoint("addProduct", AddProductCommand::class);
    }

    public function call(string $apiMethod, array $parameters) : ApiResponse
    {
        $commandClass = $this->resolveCommandClass($apiMethod);
        if(!$commandClass) {
            return new InvalidApiCallResponse("Endpoint $apiMethod does not exist or is misconfigured.");
        }
        $command=$this->commandFactory->validateAndCreate($commandClass, $parameters);
        if(!$command) {;
            $validationResult = $this->commandFactory->getValidationResult();
            return new InvalidApiCallResponse("Invalid api call", $validationResult->getErrors());
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

    private function resolveCommandClass(string $apiMethod) : ?string
    {
        foreach($this->endpoints as $endpoint) {
            if($endpoint->getApiMethod()===$apiMethod) return $endpoint->getCommandClass();
        }
        return null;
    }

}