<?php

namespace Kanel\Mapper\Transformers;

/**
 * transforms a none camel case string to a camel case one
 * examples:
 *    attribute-name => AttributeName
 *    attribute_name => AttributeName
 *    attribute name => AttributeName
 *    Attribute_NAME => AttributeName
 */
class PascalCaseTransformer extends AbstractTransformer
{
    /**
     * PascalCaseTransformer constructor.
     */
    public function __construct()
    {
        $this->transformer = function($string) {
            if (strpos($string, '_') !== false || strpos($string, '-') !== false || strpos($string, ' ') !== false) {
                return ucfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', strtolower($string)))));
            } else {
                return ucfirst($string);
            }
        };
    }
}
