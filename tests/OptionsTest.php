<?php

namespace Kanel\Mapper\Tests;

use Kanel\Mapper\Options;
use Kanel\Mapper\Transformers\CamelCaseTransformer;
use Kanel\Mapper\Transformers\CustomTransformer;
use PHPUnit\Framework\TestCase;

class OptionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testCreateNewProperty()
    {
        $options = new Options();
        $this->assertFalse($options->isCreateNewProperty());
        $options->createNewProperty(true);
        $this->assertTrue($options->isCreateNewProperty());
        $options->createNewProperty(false);
        $this->assertFalse($options->isCreateNewProperty());
    }

    public function testPropertyTransformers()
    {
        $options = new Options();
        $options->addPropertyTransformer('test', new CamelCaseTransformer());
        $this->assertInstanceof(CamelCaseTransformer::class, $options->getPropertyTransformer('test'));
        $this->assertNull($options->getPropertyTransformer('hello'));
    }

    public function testTransformers()
    {
        $options = new Options();
        $options->setTransformer(new CustomTransformer());
        $this->assertInstanceof(CustomTransformer::class, $options->getTransformer());
    }
}