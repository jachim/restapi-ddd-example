<?php


namespace Lib\CQRS;


class CommandValidationResult
{
    private bool $isValid;
    private array $errors;

    public function __construct(bool $isValid, array $errors=[])
    {
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}