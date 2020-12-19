<?php


namespace Lib\CQRS;


use LiteCQRS\Command;

abstract class BaseCommand implements Command
{
    public function __construct(array $parameters=[])
    {
        foreach($parameters as $name=>$value) {
            if(property_exists($this, $name)) {
                $this->$name=$value;
            }
        }
    }
}