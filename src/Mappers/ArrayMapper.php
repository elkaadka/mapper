<?php

namespace Kanel\Mapper\Mappers;

use Kanel\Mapper\Exceptions\InvalidDataException;

/**
 * Class ArrayMapper
 */
class ArrayMapper extends AbstractMapper
{
    /**
     * maps an array into an object
     * @param $data
     * @param $class
     * @throws InvalidDataException
     */
    public function map($data, $class)
    {
        //checks if data is a valid array
        if (!$this->isValid($data)) {
            throw new InvalidDataException('Invalid parameter: data should be an array', 500);
        }

        foreach ($data as $key => $value) {
            $propertyName = $this->getPropertyName($key);
            if (isset($propertyName)) {
                $this->copy($propertyName, $value, $class);
            }
        }
    }

    /**
     * checks if the variable sent is valid
     * @param $data
     * @return bool
     */
    public function isValid($data)
    {
        return is_array($data);
    }
}
