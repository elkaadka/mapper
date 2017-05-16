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
    public function transform($attribute)
    {
        $closure = $this->transformer;
        return $closure($attribute);
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