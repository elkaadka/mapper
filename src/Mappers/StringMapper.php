<?php

namespace Kanel\Mapper\Mappers;

use Kanel\Mapper\Exceptions\InvalidDataException;

/**
 * Class JsonMapper
 * @package Kanel\Mapper\Mappers
 */
class StringMapper extends AbstractMapper
{
    /**
     * mapps a json string into an object
     * @param $string
     * @param $class
     * @throws InvalidDataException
     */
    public function map($string, $class)
    {
        //if valid json
        if (!$this->isValid($string)) {
            throw new InvalidDataException('Invalid parameter: data should be a valid json string', 500);
        }

        try {
            $data = json_decode($string);
            $mapper = MapperFactory::createInstance(gettype($data), $this->options);
            $mapper->map($data, $class);
        } catch (\Exception $e) {
            throw new InvalidDataException('Unsupported type after json deecode : ' . gettype($data), 500);
        }
    }

    /**
     * checks if the string sent is a valid json
     * @param $string
     * @return bool
     */
    public function isValid($string): bool
    {
        return is_string($string) && json_decode($string) && json_last_error() === JSON_ERROR_NONE;
    }
}