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
            $this->isValid() && $result->isValid(),
            array_merge($this->getErrors(), $result->getErrors())
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

    public function getErrorsString(): string
    {
        return implode(", ", $this->errors);
    }

}