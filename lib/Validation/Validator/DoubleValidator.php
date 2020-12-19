<?php


namespace Lib\Validation\Validator;


class DoubleValidator extends Validator
{

    public function validateValue(mixed $value): bool
    {
        return is_double($value);
    }

    public function getErrorMessage(): string
    {
        return "This field must be double.";
    }
}