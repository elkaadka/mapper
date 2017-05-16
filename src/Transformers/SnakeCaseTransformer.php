<?php

namespace Kanel\Mapper\Transformers;

/**
 * transforms a string to snake case
 * examples:
 *    attributeName => attribute_name
 *    attribute => attribute
 */
class SnakeCaseTransformer extends AbstractTransformer
{
    /**
     * SnakeCaseTransformer constructor.
     */
    public function __construct()
    {
        // add the transformer closure
        $this->transformer = function($string) {
            return strtolower(preg_replace('/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', '_', str_replace(' ', '', $string)));
        };
    }
}
