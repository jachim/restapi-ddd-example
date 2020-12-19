<?php


namespace Lib\Validation\Attribute;

use Attribute;
use Lib\Validation\Validator\IntegerValidator;
use Lib\Validation\Validator\Validator;

#[Attribute]
class Integer extends AssertAttribute
{

    public function getValidator(): Validator
    {
        return new IntegerValidator();
    }
}