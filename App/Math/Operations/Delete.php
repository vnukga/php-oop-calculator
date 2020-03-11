<?php


namespace App\Math\Operations;

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
     */
    public function execute(array $numbers): float
    {
        return $numbers[0] / $numbers[1];
    }
}