<?php


namespace App\Math\Operations;

/**
 * Minus operation
 *
 * Class Minus
 * @package App\Math\Operations
 */
class Minus implements OperationInterface
{
    /**
     * @param array $numbers
     * @return float
     */
    public function execute(array $numbers): float
    {
        return $numbers[0] - $numbers[1];
    }
}