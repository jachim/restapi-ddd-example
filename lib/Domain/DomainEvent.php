<?php


namespace Lib\Domain;


use LiteCQRS\DomainObjectChanged;

abstract class DomainEvent extends DomainObjectChanged
{
    public function __construct(array $args=[])
    {
        parent::__construct(get_called_class(), $args);
    }

    public function getEventName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}