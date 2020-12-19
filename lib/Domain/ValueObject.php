<?php


namespace Lib\Domain;


abstract class ValueObject
{
    public function __toString() : string
    {
        return serialize($this);
    }
}