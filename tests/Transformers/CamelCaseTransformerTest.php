<?php

namespace Kanel\Mapper\Tests\Transformers;

use Kanel\Mapper\Transformers\CamelCaseTransformer;
use PHPUnit\Framework\TestCase;

class CamelCaseTransformerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testTransform()
    {
        $camelCaseTransformer = new CamelCaseTransformer();

        $this->assertEquals($camelCaseTransformer->transform('attribute-name'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('attribute_name'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('attribute name'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('Attribute_NAME'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('AttributeName'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('attributeName'), 'attributeName');
        $this->assertEquals($camelCaseTransformer->transform('attribute_firstName'), 'attributeFirstname');
    }

    public function testGetTransformer()
    {
        $camelCaseTransformer = new CamelCaseTransformer();
        $this->assertTrue(is_callable($camelCaseTransformer->getTransformer()));
    }
}