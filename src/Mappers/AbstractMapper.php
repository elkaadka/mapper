<?php

namespace Kanel\Mapper\Mappers;

use Kanel\Mapper\Options;
use Kanel\Mapper\Transformers\TransformerInterface;

/**
 * Class AbstractMapper
 * @package Kanel\Mapper\Mappers
 */
abstract class AbstractMapper implements MapperInterface
{
    protected $reflection = null;
    protected $options;

    /**
     * AbstractMapper constructor.
     * @param Options|null $options
     */
    public function __construct(Options $options = null)
    {
        $this->options = $options;
    }

    /**
     * Copies the value of a property into a class
     * @param string $propertyName the name of the property to copy into
     * @param $propertyValue the value to copy
     * @param $class the class to copy into
     */
    public function copy(string $propertyName, $propertyValue, $class)
    {
        $this->reflection = $this->reflection?? new \ReflectionObject($class);
        if ($this->reflection->hasProperty($propertyName)) {
            $reflectionProperty = $this->reflection->getProperty($propertyName);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($class, $propertyValue);
        } elseif (isset($this->options) && $this->options->isCreateNewProperty()) {
            $class->$propertyName = $propertyValue;
        }
    }

    /**
     * transforms a property name using the transformers if any
     * @param $property
     * @return null
     */
    public function getPropertyName($property)
    {
        $transformerClass = $this->options? $this->options->getPropertyTransformer($property)?? $this->options->getTransformer(): null;
        if ($transformerClass instanceof TransformerInterface) {
            $property = $transformerClass->transform($property);
            if (!is_string($property) || trim($property)=== '') {
                return null;
            }
        }

        return $property;
    }
}