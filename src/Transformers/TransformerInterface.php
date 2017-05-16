<?php

namespace Kanel\Mapper\Transformers;

/**
 * Interface TransformerInterface
 * @package Kanel\Mapper\Transformers
 */
interface TransformerInterface
{
    public function transform($attribute);

    public function getTransformer();
}