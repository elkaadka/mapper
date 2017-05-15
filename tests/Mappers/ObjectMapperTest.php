<?php

namespace Kanel\Mapper\Test\Mappers;


use Kanel\Mapper\Mappers\ObjectMapper;
use Kanel\Mapper\Tests\Fixtures\MyClassExample;
use PHPUnit\Framework\TestCase;

class ObjectMapperTest extends TestCase
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
        $objectMapper = new ObjectMapper();
        $this->assertFalse($objectMapper->isValid('Test'));
        $this->assertFalse($objectMapper->isValid(1));
        $this->assertFalse($objectMapper->isValid(true));
        $this->assertFalse($objectMapper->isValid([]));
        $this->assertFalse($objectMapper->isValid([1, 2]));
        $this->assertFalse($objectMapper->isValid(['test' => 1, 'test2' => 2]));
        $this->assertFalse($objectMapper->isValid(json_encode(['test' => 1, 'test2' => 2])));
        $this->assertFalse($objectMapper->isValid('{"test": "ok"}'));
        $this->assertTrue($objectMapper->isValid(new MyClassExample()));
        $this->assertTrue($objectMapper->isValid((object)[1, 2]));
        $this->assertTrue($objectMapper->isValid((object)json_decode(json_encode(['test' => 1]))));
    }

    public function testMap()
    {
        $mapper = new ObjectMapper();
        $class =  new MyClassExample();
        $data = ['testOne' => 1, 'testTwo' => 2, 'testThree' => 3, 'testFour' => 4];

        $mapper->map((object)$data, $class);
        $this->assertEquals($class->getTestOne(), 1);
        $this->assertEquals($class->getTestTwo(), 2);
        $this->assertEquals($class->getTestThree(), 3);
        $this->assertFalse(property_exists($class, 'testFour'));

        $classFrom =  new MyClassExample();
        $classTo = new MyClassExample();
        $classFrom->setTestOne(1);
        $classFrom->setTestTwo(2);
        $classFrom->setTestThree(3);
        $mapper->map($classFrom, $classTo);
        $this->assertEquals($classTo->getTestOne(), 1);
        $this->assertEquals($classTo->getTestTwo(), 2);
        $this->assertEquals($classTo->getTestThree(), 3);
    }

    public function testCopy()
    {
        $objectMapper = new ObjectMapper();
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
