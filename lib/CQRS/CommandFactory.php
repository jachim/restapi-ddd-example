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
        $this->validateCommand($reflectionClass, $parameters);
        if($this->validationResult->isValid()) {
            $command = $reflectionClass->newInstance($parameters);
            return $command;
        }
        return null;
    }

    public function getValidationResult(): ValidationResult
    {
        return $this->validationResult;
    }

    private function validateCommand(\ReflectionClass $commandReflectionClass, array $parameters) : void
    {
        if($commandReflectionClass->getParentClass()?->getName() !== BaseCommand::class) {
            $this->validationResult = new ValidationResult(false, ["Command class should extend ".BaseCommand::class."."]);
            return;
        }

        $classPropertiesValidator=new ClassPropertiesValidator();
        $validationResult=$classPropertiesValidator->validate($commandReflectionClass, $parameters);
        $this->validationResult=$validationResult;
    }
}