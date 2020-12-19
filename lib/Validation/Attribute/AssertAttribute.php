<?php


namespace Lib\Validation\Attribute;


use Lib\Validation\Validator\Validator;

abstract class AssertAttribute
{
    abstract public function getValidator() : Validator;
}