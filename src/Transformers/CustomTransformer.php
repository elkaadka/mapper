<?php

namespace Kanel\Mapper\Transformers;

/**
 * Class CustomTransformer
 * @package Kanel\Mapper\Transformers
 */
class CustomTransformer extends AbstractTransformer
{
    /**
     * setter for transformer
     * @param callable $transformer
     * @return TransformerInterface
     */
    public function setTransformer(callable $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }
}