<?php


namespace App\Application\Api\Response;


abstract class ApiResponse
{
    protected int $statusCode;

    public function __construct(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    abstract public function __toString() : string;

}