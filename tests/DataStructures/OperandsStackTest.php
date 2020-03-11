<?php


namespace DataStructures;

use App\DataStructures\OperandsStack;
use PHPUnit\Framework\TestCase;

class OperandsStackTest extends TestCase
{
    public function testGettingPreviousOperand()
    {
        $stack = new OperandsStack();
        $result = $stack->getPrevOperand();
        $this->assertNull($result);

        $stack->push('+');
        $result = $stack->getPrevOperand();
        $this->assertEquals('+', $result);
    }
}