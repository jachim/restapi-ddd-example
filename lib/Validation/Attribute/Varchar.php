<?php


namespace Lib\Validation\Attribute;

use Attribute;

#[Attribute]
class Varchar
{
    private int $length;

    public function __construct(int $length)
    {
        $this->length = $length;
    }
}