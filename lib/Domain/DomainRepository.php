<?php


namespace Lib\Domain;


interface DomainRepository
{
    public function save(Aggregate $aggregate) : void;
}