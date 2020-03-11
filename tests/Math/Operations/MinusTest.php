<?php


namespace Math\Operations;

use App\Math\Operations\Minus;
use PHPUnit\Framework\TestCase;

class MinusTest extends TestCase
{
    public function testExecution()
    {
        $operation = new Minus();
        $numbers = ['2', '1'];
        $result = $operation->execute($numbers);
        $this->assertEquals(1, $result);
    }
}