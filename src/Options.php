<?php

namespace Kanel\Mapper;

use Kanel\Mapper\Transformers\TransformerInterface;

/**
 * Class Options
 * @package Kanel\Mapper
 */
class Options
{
    protected $createNewProperty = false;
    protected $propertyTransformers = null;
    protected $transformer = null;

    /**
     * returns the value for createNewProperty
     * @return boolean
     */
    public function isCreateNewProperty()
    {
        return $this->createNewProperty;
    }

    /**
     * Set to true to create new property in class, false otherwise (default is false)
     * @param bool $createNewProperty
     * @return Options
     */
    public function createNewProperty($createNewProperty)
    {
        $this->createNewProperty = $createNewProperty;

        return $this;
    }

    /**
     * get all the transformers of all the properties
     * @return null
     */
    public function getPropertyTransformers()
    {
        return $this->propertyTransformers;
    }

    /**
     * get a specific transformer for a given aproperty
     * @param string $property
     * @return null
     */
    public function getPropertyTransformer($property)
    {
        return isset($this->propertyTransformers[$property])? $this->propertyTransformers[$property] :  null;
    }

    /**
     * Adds a transformer to a specific property
     * @param string $property
     * @param TransformerInterface $transformer
     * @return Options
     */
    public function addPropertyTransformer($property, TransformerInterface $transformer)
    {
        $this->propertyTransformers[$property] = $transformer;

        return $this;
    }

    /**
     * gets the generic transformer
     * @return null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * sets the generic transformer
     * @param TransformerInterface $transformer
     * @return Options
     */
    public function setTransformer(TransformerInterface $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }
}