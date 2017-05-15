<?php

namespace Kanel\Mapper\Mappers;

/**
 * Class ObjectMapper
 */
class ObjectMapper extends AbstractMapper
{
    /**
     * maps an object into another
     * @param $data the source object
     * @param $class the target object
     * @throws InvalidDataException
     */
    public function map($data, $class)
    {
        //check if data is an object
        if (!$this->isValid($data)) {
            throw new InvalidDataException('Invalid parameter: data should be an object', 500);
        }
        //Create a ReflectionObject to go through all the properties
        $reflectionClass = new \ReflectionObject($data);
        $properties = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            //make a property accessible
            $property->setAccessible(true);
            $propertyName = $this->getPropertyName($property->getName());
            if (isset($propertyName)) {
                $this->copy($propertyName, $property->getValue($data), $class);
            }

        }
    }

    /**
     * checks the validity of the data
     * @param $data
     * @return bool
     */
    public function isValid($data): bool
    {
        return is_object($data);
    }
}