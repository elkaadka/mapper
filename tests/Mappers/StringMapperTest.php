<?php

namespace Kanel\Mapper\Test\Mappers;


use Kanel\Mapper\Mappers\StringMapper;
use Kanel\Mapper\Tests\Fixtures\MyClassExample;
use PHPUnit\Framework\TestCase;

class StringMapperTest extends TestCase
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
        $stringMapper = new StringMapper();
        $this->assertFalse($stringMapper->isValid('Test'));
        $this->assertFalse($stringMapper->isValid(1));
        $this->assertFalse($stringMapper->isValid(true));
        $this->assertFalse($stringMapper->isValid([]));
        $this->assertFalse($stringMapper->isValid([1, 2]));
        $this->assertFalse($stringMapper->isValid(['test' => 1, 'test2' => 2]));
        $this->assertFalse($stringMapper->isValid(new MyClassExample()));
        $this->assertFalse($stringMapper->isValid((object)[1, 2]));
        $this->assertFalse($stringMapper->isValid((object)json_decode(json_encode(['test' => 1]))));
        $this->assertTrue($stringMapper->isValid(json_encode(['test' => 1, 'test2' => 2])));
        $this->assertTrue($stringMapper->isValid('{"test": "ok"}'));
    }

    public function testMap()
    {
        $mapper = new StringMapper();
        $class =  new MyClassExample();
        $data = json_encode(['testOne' => 1, 'testTwo' => 2, 'testThree' => 3, 'testFour' => 4]);

        $mapper->map($data, $class);
        $this->assertEquals($class->getTestOne(), 1);
        $this->assertEquals($class->getTestTwo(), 2);
        $this->assertEquals($class->getTestThree(), 3);
        $this->assertFalse(property_exists($class, 'testFour'));
    }

    public function testCopy()
    {
        $objectMapper = new StringMapper();
        $classExample = new MyClassExample();

        $objectMapper->copy('testOne', 1, $classExample);
        $this->assertEquals($classExample->getTestOne(), 1);

        $objectMapper->copy('testOne', 'Hellow world', $classExample);
        $this->assertEquals($classExample->getTestOne(), 'Hellow world');

        $objectMapper->copy('testOne', true, $classExample);
        $this->assertTrue($classExample->getTestOne());

        $objectMapper->copy('testOne', new MyClassExample(), $classExample);
        $this->assertInstanceOf(MyClassExample::class, $classExample->getTestOne());

        $objectMapper->copy('testOne', [1, 2, 3], $classExample);
        $this->assertEquals($classExample->getTestOne(), [1, 2, 3]);

        $objectMapper->copy('testOne', null, $classExample);
        $this->assertNull($classExample->getTestOne());
    }
}
