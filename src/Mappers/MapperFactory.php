<?php

namespace Kanel\Mapper\Mappers;

use Kanel\Mapper\Exceptions\MapperNotFound;
use Kanel\Mapper\Options;

/**
 * Class MapperFactory
 * @package Kanel\Mapper\Mappers
 */
class MapperFactory
{
    /**
     * creates a mapper
     * @param string $mapperName
     * @param Options $options
     * @return mixed
     * @throws MapperNotFound
     */
    public static function createInstance(string $mapperName, Options $options = null)
    {
        $mapperClass = __NAMESPACE__ . '\\' . ucfirst($mapperName) . 'Mapper';
        if (class_exists($mapperClass)) {
            return new $mapperClass($options);
        }

        throw new MapperNotFound('Unknown mapper ' . $mapperName);
    }
}