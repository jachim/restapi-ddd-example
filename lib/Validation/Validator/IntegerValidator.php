<?php


namespace Lib\Validation\Validator;


class IntegerValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return is_int($value);
    }

    public function getErrorMessage(): string
    {
        return "This field must be integer.";
    }
}