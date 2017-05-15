<?php

namespace Kanel\Mapper;

use Kanel\Mapper\Exceptions\InvalidDataException;
use Kanel\Mapper\Mappers\MapperFactory;

/**
 * Class Mapper
 * @package Kanel\Mapper
 */
class Mapper
{
    protected $options;

    /**
     * Mapper constructor.
     * @param Options|null $options
     */
    public function __construct(Options $options = null)
    {
        $this->options = $options;
    }

    /**
     * maps a string, an object or an array to a class
     * @param $from
     * @param $toClass
     * @throws InvalidDataException
     */
    public function map($from, $toClass)
    {
        //check if $toClass is an object
        if (!is_object($toClass)) {
            throw new InvalidDataException('Parameter 2 should be an object, ' . gettype($toClass) . ' sent ', 500);
        }

        try {
            //Get the correct mapper based on the type of $from
            $mapper = MapperFactory::createInstance(gettype($from), $this->options);
        } catch (\Exception $e) {
            throw new InvalidDataException('Unsupported type for parameter 1 : ' . gettype($from), 500);
        }

        $mapper->map($from, $toClass);
    }
}
