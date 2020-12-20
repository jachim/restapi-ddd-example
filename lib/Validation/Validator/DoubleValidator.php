<?php


namespace Lib\Validation\Validator;


class DoubleValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return is_numeric($value);
    }

    public function generateErrorMessage(string $fieldName): string
    {
        return "'$fieldName' must be a double.";
    }
}