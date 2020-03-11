<?php


namespace App\Math;

use App\Math\Operations\Delete;
use App\Math\Operations\Minus;
use App\Math\Operations\Multiply;
use App\Math\Operations\OperationInterface;
use App\Math\Operations\Plus;

/**
 * Class Operation
 * @package App\Math
 */
class Operation
{
    /**
     * Priorities of operand's execution
     * @var array
     */
    private $operandPriority = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2
    ];

    /**
     * Executes operation
     *
     * @param array $numbers
     * @param string $operand
     * @return float
     */
    public function calculate(array $numbers, string $operand) : float
    {
        switch ($operand) {
            case '+':
                $operation = new Plus();
                break;
            case '-':
                $operation = new Minus();
                break;
            case '*':
                $operation = new Multiply();
                break;
            case '/':
                $operation = new Delete();
                break;
        }
        return $this->executeOperation($numbers, $operation);
    }

    /**
     * Compares two operands priority
     *
     * @param string $firstOperand
     * @param string|null $secondOperand
     * @return bool
     */
    public function compareOperandsPriority(string $firstOperand, ?string $secondOperand) : bool
    {
        if(!$secondOperand) {
            return false;
        }
        $firstOperandPriority = $this->getPriority($firstOperand);
        $secondOperandPriority = $this->getPriority($secondOperand);
        if($firstOperandPriority && $secondOperandPriority) {
            return $secondOperandPriority >= $firstOperandPriority;
        }
        return false;
    }

    /**
     * Returns priority of operand
     *
     * @param string $operand
     * @return int|null
     */
    private function getPriority(string $operand) : ?int
    {
        if($priority = $this->operandPriority[$operand]) {
            return $priority;
        }
        return null;
    }

    /**
     * Executes operation from expression
     *
     * @param array $numbers
     * @param OperationInterface $operation
     * @return float
     */
    private function executeOperation(array $numbers, OperationInterface $operation)
    {
        return $operation->execute($numbers);
    }
}