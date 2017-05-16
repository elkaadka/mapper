<?php

namespace Kanel\Mapper\Mappers;

/**
 * Interface MapperInterface
 * @package Kanel\Mapper\Mappers
 */
interface MapperInterface
{
    public function map($data, $class);

    public function copy($propertyName, $propertyValue, $class);

    public function isValid($data);

}