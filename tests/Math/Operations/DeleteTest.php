<?php


namespace Math\Operations;

use App\Math\Operations\Delete;
use App\Math\Operations\Exceptions\DivisionByZeroException;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    public function testExecution()
    {
        $operation = new Delete();
        $numbers = ['2', '2'];
        $result = $operation->execute($numbers);
        $this->assertEquals(1, $result);

        $numbers = ['2', '0'];
        $this->expectException(DivisionByZeroException::class);
        $operation->execute($numbers);
    }
}