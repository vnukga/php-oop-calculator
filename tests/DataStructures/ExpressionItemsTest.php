<?php


namespace DataStructures;

use App\DataStructures\Exceptions\InvalidExpressionException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use App\DataStructures\ExpressionItems;

class ExpressionItemsTest extends TestCase
{
    public function testCurrentItemIsNumeric()
    {
        $class = new ExpressionItems('5+2');

        $class->rewind();
        $result = $class->isCurrentItemNumeric();
        $this->assertTrue($result);

        $class->next();
        $result = $class->isCurrentItemNumeric();
        $this->assertFalse($result);
    }

    public function testHandlingExpression()
    {
        $class = new ReflectionClass(ExpressionItems::class);
        $method = $class->getMethod('handleExpression');
        $method->setAccessible(true);
        $obj = new ExpressionItems('');

        $method->invoke($obj, '15+2');
        $this->assertEquals(3, count($obj));
    }

    public function testValidatingExpression()
    {
        $class = new ReflectionClass(ExpressionItems::class);
        $method = $class->getMethod('validateExpression');
        $method->setAccessible(true);
        $obj = new ExpressionItems('');

        $result = $method->invoke($obj, '15+2');
        $this->assertNull($result);

        $this->expectException(InvalidExpressionException::class);
        $method->invoke($obj, '1.5+2');

        $this->expectException(InvalidExpressionException::class);
        $method->invoke($obj, '1j+2');
    }

    public function testCheckIsNumeric()
    {
        $class = new ReflectionClass(ExpressionItems::class);
        $method = $class->getMethod('checkIsNumeric');
        $method->setAccessible(true);
        $obj = new ExpressionItems('5');

        $result = $method->invoke($obj, '5');
        $this->assertTrue($result);

        $result = $method->invoke($obj, 'a');
        $this->assertFalse($result);
    }
}