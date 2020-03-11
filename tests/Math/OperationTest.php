<?php


namespace Math;

use App\Math\Exceptions\InvalidOperationException;
use App\Math\Operation;
use App\Math\Operations\Plus;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class OperationTest extends TestCase
{
    public function testCalculate()
    {
        $operation = new Operation();
        $numbers = ['6', '2'];

        $operand = '+';
        $result = $operation->calculate($numbers, $operand);
        $this->assertEquals($result, 8);

        $operand = '-';
        $result = $operation->calculate($numbers, $operand);
        $this->assertEquals($result, 4);

        $operand = '*';
        $result = $operation->calculate($numbers, $operand);
        $this->assertEquals($result, 12);

        $operand = '/';
        $result = $operation->calculate($numbers, $operand);
        $this->assertEquals($result, 3);

        $operand = '.';
        $this->expectException(InvalidOperationException::class);
        $operation->calculate($numbers, $operand);
    }

    public function testComparingOperandsPriority()
    {
        $operation = new Operation();
        $result = $operation->compareOperandsPriority('-', '+');
        $this->assertTrue($result);

        $result = $operation->compareOperandsPriority('/', '+');
        $this->assertFalse($result);

        $result = $operation->compareOperandsPriority('-', '-');
        $this->assertTrue($result);

        $result = $operation->compareOperandsPriority('-', null);
        $this->assertFalse($result);

        $result = $operation->compareOperandsPriority('-', '*');
        $this->assertTrue($result);
    }

    public function testGettingPriority()
    {
        $class = new ReflectionClass(Operation::class);
        $method = $class->getMethod('getPriority');
        $method->setAccessible(true);
        $obj = new Operation();

        $result = $method->invoke($obj, '+');
        $this->assertEquals(1, $result);

        $result = $method->invoke($obj, '-');
        $this->assertEquals(1, $result);

        $result = $method->invoke($obj, '/');
        $this->assertEquals(2, $result);

        $result = $method->invoke($obj, '*');
        $this->assertEquals(2, $result);

        $result = $method->invoke($obj, '.');
        $this->assertNull( $result);
    }

    public function testExecutingOperation()
    {
        $class = new ReflectionClass(Operation::class);
        $method = $class->getMethod('executeOperation');
        $method->setAccessible(true);
        $obj = new Operation();
        $plusOperation = new Plus();
        $numbers = ['2', '1'];

        $result = $method->invoke($obj, $numbers, $plusOperation);
        $this->assertEquals(3, $result);
    }
}