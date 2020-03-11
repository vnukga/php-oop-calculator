<?php


namespace App\Math\Operations;

/**
 * Plus operation
 *
 * Class Plus
 * @package App\Math\Operations
 */
class Plus implements OperationInterface
{
    /**
     * @param array $numbers
     * @return float
     */
    public function execute(array $numbers): float
    {
        return $numbers[0] + $numbers[1];
    }
}