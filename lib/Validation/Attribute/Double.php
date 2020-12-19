<?php


namespace Lib\Validation\Attribute;

use Attribute;
use Lib\Validation\Validator\DoubleValidator;
use Lib\Validation\Validator\Validator;

#[Attribute]
class Double extends AssertAttribute
{

    public function getValidator(): Validator
    {
        return new DoubleValidator();
    }
}