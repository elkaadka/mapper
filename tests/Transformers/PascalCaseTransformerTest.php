<?php

namespace Kanel\Mapper\Tests\Transformers;

use Kanel\Mapper\Transformers\PascalCaseTransformer;
use PHPUnit\Framework\TestCase;

class PascalCaseTransformerTest extends TestCase
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
        $pascalCaseTransformer = new PascalCaseTransformer();

        $this->assertEquals($pascalCaseTransformer->transform('attribute-name'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('attribute_name'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('attribute name'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('Attribute_NAME'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('AttributeName'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('attributeName'), 'AttributeName');
        $this->assertEquals($pascalCaseTransformer->transform('attribute_firstName'), 'AttributeFirstname');
    }

    public function testGetTransformer()
    {
        $pascalCaseTransformer = new PascalCaseTransformer();
        $this->assertTrue(is_callable($pascalCaseTransformer->getTransformer()));
    }
}