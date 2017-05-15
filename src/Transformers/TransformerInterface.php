<?php

namespace Kanel\Mapper\Transformers;

/**
 * Interface TransformerInterface
 * @package Kanel\Mapper\Transformers
 */
interface TransformerInterface
{
    public function transform(string $attribute);

    public function getTransformer();
}