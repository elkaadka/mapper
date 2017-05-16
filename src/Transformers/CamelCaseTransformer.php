<?php

namespace Kanel\Mapper\Transformers;

/**
 * transforms a none camel case string to a camel case one
 * examples:
 *    attribute-name => attributeName
 *    attribute_name => attributeName
 *    attribute name => attributeName
 *    Attribute_NAME => attributeName
 *    AttributeName  => attributeName
 *    attributeName  => attributeName
 *    attribute_firstName => attributeFirstname
 */
class CamelCaseTransformer extends AbstractTransformer
{
    /**
     * CamelCaseTransformer constructor.
     */
    public function __construct()
    {
        //create the transformer as a closure
        $this->transformer = function(string $string): string {
            if (strpos($string, '_') !== false || strpos($string, '-') !== false || strpos($string, ' ') !== false) {
                return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', strtolower($string)))));
            } else {
                return lcfirst($string);
            }
        };
    }


}