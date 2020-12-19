<?php


namespace App\Application\Api\Response;


class InvalidApiCallResponse extends ApiResponse
{
    private string $message;
    private array $errors;

    public function __construct(string $message, array $errors = [])
    {
        $this->message = $message;
        $this->errors = $errors;
        parent::__construct(500);
    }

    public function __toString(): string
    {
        $std=new \stdClass();
        $std->statusCode=$this->statusCode;
        $std->message=$this->message;
        $std->errors=$this->errors;
        return json_encode($std);
    }
}