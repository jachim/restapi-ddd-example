<?php


namespace App\Application\Api;


class Endpoint
{
    private string $apiMethod;
    private string $commandClass;

    public function __construct(string $apiMethod, string $commandClass)
    {
        $this->apiMethod = $apiMethod;
        $this->commandClass = $commandClass;
    }

    public function getApiMethod(): string
    {
        return $this->apiMethod;
    }

    public function getCommandClass(): string
    {
        return $this->commandClass;
    }

}