<?php


namespace Lib\Validation\Validator;


abstract class Validator
{
    abstract public function validateValue(mixed $value) : bool;

    abstract public function getErrorMessage() : string;
}