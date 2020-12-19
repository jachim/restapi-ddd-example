<?php


namespace Lib\Validation\Attribute;

use Attribute;
use Lib\Validation\Validator\RequiredValidator;
use Lib\Validation\Validator\Validator;

#[Attribute]
class Required extends AssertAttribute
{

    public function getValidator(): Validator
    {
        return new RequiredValidator();
    }
}