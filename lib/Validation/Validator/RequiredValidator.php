<?php


namespace Lib\Validation\Validator;


class RequiredValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return !empty($value);
    }

    public function getErrorMessage(): string
    {
        return "This field is required.";
    }
}