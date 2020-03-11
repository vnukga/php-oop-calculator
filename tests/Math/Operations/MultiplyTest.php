<?php


namespace Math\Operations;

use App\Math\Operations\Multiply;
use PHPUnit\Framework\TestCase;

class MultiplyTest extends TestCase
{
    public function testExecution()
    {
        $operation = new Multiply();
        $numbers = ['1', '2'];
        $result = $operation->execute($numbers);
        $this->assertEquals(2, $result);
    }
}