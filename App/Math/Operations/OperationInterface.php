<?php


namespace App\Math\Operations;

/**
 * Interface for mathematical operations
 *
 * Interface OperationInterface
 * @package App\Math\Operations
 */
interface OperationInterface
{
    /**
     * Operation's execution
     *
     * @param array $numbers
     * @return float
     */
    public function execute(array $numbers) : float;
}