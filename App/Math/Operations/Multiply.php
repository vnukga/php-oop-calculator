<?php


namespace App\Math\Operations;

/**
 * Multiply operation
 *
 * Class Multiply
 * @package App\Math\Operations
 */
class Multiply implements OperationInterface
{
    /**
     * @param array $numbers
     * @return float
     */
    public function execute(array $numbers): float
    {
        return $numbers[0] * $numbers[1];
    }
}