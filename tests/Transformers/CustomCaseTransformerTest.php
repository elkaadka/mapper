<?php

namespace Kanel\Mapper\Tests\Transformers;

use Kanel\Mapper\Transformers\CustomTransformer;
use PHPUnit\Framework\TestCase;

class CustomCaseTransformerTest extends TestCase
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
        $customerTransformer = new CustomTransformer();
        $customerTransformer->setTransformer(function($string) {
            return 'hello world';
        });

        $this->assertEquals($customerTransformer->transform('my string'), 'hello world');
    }
}