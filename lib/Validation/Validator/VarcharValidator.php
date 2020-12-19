<?php


namespace Lib\Validation\Validator;


class VarcharValidator extends Validator
{

    private ?int $length;

    public function __construct(?int $maxLength)
    {
        $this->length = $maxLength;
    }

    public function validateValue(mixed $value): bool
    {
        return is_string($value);
    }

    public function getErrorMessage(): string
    {
        return "This field must be a varchar({$this->length})";
    }
}