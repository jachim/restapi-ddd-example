<?php


namespace Lib\Validation;


use Lib\Validation\Attribute\AssertAttribute;
use Lib\Validation\Validator\Validator;

class ClassPropertiesValidator
{
    public function validate(\ReflectionClass $reflectionClass, array $values) : ValidationResult
    {
        $validationResult=new ValidationResult(true);
        foreach($reflectionClass->getProperties() as $property) {
            $propertyName = $property->getName();
            $propertyValue=array_key_exists($propertyName, $values) ? $values[$propertyName] : null;
            $validationResult->merge($this->validateProperty($property, $propertyValue));
        }
        return $validationResult;
    }

    private function validateProperty(\ReflectionProperty $property, mixed $propertyValue) : ValidationResult
    {
        $validators=$this->getValidatorsForProperty($property);
        foreach($validators as $validator) {
            if(!$validator->validateValue($propertyValue)) {
                $error="[".$property->getName()."] ".$validator->getErrorMessage();
                return new ValidationResult(false, [$error]);
            }
        }
        return new ValidationResult(true);
    }

    /**
     * @return Validator[]
     */
    private function getValidatorsForProperty(\ReflectionProperty $property) : array
    {
        $validators=[];
        foreach($property->getAttributes() as $attribute) {
            $assert=$attribute->newInstance();
            if($assert instanceof AssertAttribute) {
                try {
                    $validators[] = $assert->getValidator();
                } catch (\ReflectionException) {};
            }
        }
        return $validators;
    }
}