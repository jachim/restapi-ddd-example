<?php


namespace Lib\Validation\Validator;


class RequiredValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return !empty($value);
    }

    public function generateErrorMessage(string $fieldName) : string
    {
        return "'$fieldName' is required.";
    }
}