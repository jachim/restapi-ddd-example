<?php


namespace Lib\Validation;


final class ValidationResult
{
    private bool $isValid;

    private array $errors;

    public function __construct(bool $isValid, array $errors=[])
    {
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    public function merge(ValidationResult $result) : ValidationResult
    {
        return new ValidationResult(
            $result->isValid() && $this->isValid(),
            array_merge($result->getErrors(), $result->getErrors())
        );
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