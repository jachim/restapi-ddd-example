<?php


namespace Lib\Validation\Validator;


class IntegerValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return is_int($value);
    }

    public function generateErrorMessage(string $fieldName): string
    {
        return "'$fieldName' must be an integer.";
    }
}