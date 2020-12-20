<?php


namespace Lib\Validation\Validator;


class VarcharValidator extends Validator
{

    private ?int $maxLength;

    public function __construct(?int $maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validateValue(mixed $value): bool
    {
        return is_string($value) && strlen((string)$value) <= $this->maxLength;
    }

    public function generateErrorMessage(string $fieldName) : string
    {
        return "'$fieldName' must be a varchar({$this->maxLength}).";
    }
}