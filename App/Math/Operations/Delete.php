<?php


namespace App\Math\Operations;

use App\Math\Operations\Exceptions\DivisionByZeroException;

/**
 * Delete operation
 *
 * Class Delete
 * @package App\Math\Operations
 */
class Delete implements OperationInterface
{
    /**
     * @param array $numbers
     * @return float
     * @throws DivisionByZeroException
     */
    public function execute(array $numbers): float
    {
        if($numbers[1] == 0) {
            throw new DivisionByZeroException('Division by zero!');
        }
        return $numbers[0] / $numbers[1];
    }
}