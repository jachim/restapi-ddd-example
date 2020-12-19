<?php


namespace Lib\CQRS;


use JetBrains\PhpStorm\Pure;

class CommandValidator
{
    public function validateCommand(BaseCommand $command) : CommandValidationResult
    {
        $validationResult=$this->doValidate($command);
        return $validationResult;
    }

    private function doValidate(BaseCommand $command) : CommandValidationResult
    {
        return new CommandValidationResult(true);
    }
}