<?php

namespace Kanel\Mapper\Transformers;

/**
 * Class AbstractTransformer
 * @package Kanel\Mapper\Transformers
 */
abstract class AbstractTransformer implements TransformerInterface
{
    protected $transformer;

    /**
     * apply the transform closure
     * @param string $attribute
     * @return string
     */
    public function transform(string $attribute)
    {
        return ($this->transformer)($attribute);
    }

    /**
     * getter for transformer attribute
     * @return callable or null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }
}