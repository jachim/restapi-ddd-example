<?php
namespace Lib\CQRS;

use Lib\Validation\ClassPropertiesValidator;
use Lib\Validation\ValidationResult;

class CommandFactory
{
    private ValidationResult $validationResult;

    public function validateAndCreate(string $className, array $parameters) : ?BaseCommand
    {
        $reflectionClass=new \ReflectionClass($className);
        $this->validationResult = $this->validateCommand($reflectionClass, $parameters);
        if($this->validationResult->isValid()) {
            $command = $reflectionClass->newInstance($parameters);
            return $command;
        }
    }

    public function getValidationResult(): ValidationResult
    {
        return $this->validationResult;
    }

    private function validateCommand(\ReflectionClass $commandReflectionClass, array $parameters) : ValidationResult
    {
        if($commandReflectionClass->getParentClass()?->getName() !== BaseCommand::class) {
           return new ValidationResult(false, ["Command class should extend ".BaseCommand::class."."]);
        }

        $classPropertiesValidator=new ClassPropertiesValidator();
        $validationResult=$classPropertiesValidator->validate($commandReflectionClass, $parameters);
        return $validationResult;
    }
}