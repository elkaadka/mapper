<?php

namespace Kanel\Mapper\Test\Mappers;


use Kanel\Mapper\Mappers\ArrayMapper;
use Kanel\Mapper\Tests\Fixtures\MyClassExample;
use PHPUnit\Framework\TestCase;

class ArrayMapperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testIsValid()
    {
        $arrayMapper = new ArrayMapper();
        $this->assertFalse($arrayMapper->isValid('Test'));
        $this->assertFalse($arrayMapper->isValid(1));
        $this->assertFalse($arrayMapper->isValid(new MyClassExample()));
        $this->assertFalse($arrayMapper->isValid(true));
        $this->assertFalse($arrayMapper->isValid(json_encode(['test' => 1, 'test2' => 2])));
        $this->assertFalse($arrayMapper->isValid('{"test": "ok"}'));
        $this->assertTrue($arrayMapper->isValid([]));
        $this->assertTrue($arrayMapper->isValid([1, 2]));
        $this->assertTrue($arrayMapper->isValid(['test' => 1, 'test2' => 2]));
    }

    public function testMap()
    {
        $mapper = new ArrayMapper();
        $class =  new MyClassExample();
        $data = ['testOne' => 1, 'testTwo' => 2, 'testThree' => 3, 'testFour' => 4];

        $mapper->map($data, $class);
        $this->assertEquals($class->getTestOne(), 1);
        $this->assertEquals($class->getTestTwo(), 2);
        $this->assertEquals($class->getTestThree(), 3);
        $this->assertFalse(property_exists($class, 'testFour'));
    }

    public function testCopy()
    {
        $arrayMapper = new ArrayMapper();
        $classExample = new MyClassExample();

        $arrayMapper->copy('testOne', 1, $classExample);
        $this->assertEquals($classExample->getTestOne(), 1);

        $arrayMapper->copy('testOne', 'Hellow world', $classExample);
        $this->assertEquals($classExample->getTestOne(), 'Hellow world');

        $arrayMapper->copy('testOne', true, $classExample);
        $this->assertTrue($classExample->getTestOne());

        $arrayMapper->copy('testOne', new MyClassExample(), $classExample);
        $this->assertInstanceOf(MyClassExample::class, $classExample->getTestOne());

        $arrayMapper->copy('testOne', [1, 2, 3], $classExample);
        $this->assertEquals($classExample->getTestOne(), [1, 2, 3]);

        $arrayMapper->copy('testOne', null, $classExample);
        $this->assertNull($classExample->getTestOne());
    }
}
