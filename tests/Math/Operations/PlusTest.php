<?php


namespace Math\Operations;

use App\Math\Operations\Plus;
use PHPUnit\Framework\TestCase;

class PlusTest extends TestCase
{
    public function testExecution()
    {
        $operation = new Plus();
        $numbers = ['1', '2'];
        $result = $operation->execute($numbers);
        $this->assertEquals(3, $result);
    }
}