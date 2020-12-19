<?php


namespace Lib\Validation\Attribute;

use Attribute;
use Lib\Validation\Validator\Validator;
use Lib\Validation\Validator\VarcharValidator;

#[Attribute]
class Varchar extends AssertAttribute
{
    private ?int $length;

    public function __construct(int $length)
    {
        $this->length = $length;
    }

    public function getValidator(): Validator
    {
        return new VarcharValidator($this->length);
    }
}