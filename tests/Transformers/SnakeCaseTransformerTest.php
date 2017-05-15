<?php

namespace Kanel\Mapper\Tests\Transformers;

use Kanel\Mapper\Transformers\SnakeCaseTransformer;
use PHPUnit\Framework\TestCase;

class SnakeCaseTransformerTest extends TestCase
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
        $snakeCaseTransformer = new SnakeCaseTransformer();

        $this->assertEquals($snakeCaseTransformer->transform('attributeName'), 'attribute_name');
        $this->assertEquals($snakeCaseTransformer->transform('AttributeName'), 'attribute_name');
        $this->assertEquals($snakeCaseTransformer->transform('attribute Name'), 'attribute_name');
        $this->assertEquals($snakeCaseTransformer->transform('attributeFirstName'), 'attribute_first_name');
    }

    public function testGetTransformer()
    {
        $snakeCaseTransformer = new SnakeCaseTransformer();
        $this->assertTrue(is_callable($snakeCaseTransformer->getTransformer()));
    }
}