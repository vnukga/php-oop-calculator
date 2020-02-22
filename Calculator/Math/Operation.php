<?php


namespace App\Math;

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
     * @return int
     */
    public function calculate(array $numbers, string $operand) : int
    {
        switch ($operand) {
            case '+':
                $result = $this->plus($numbers);
                break;
            case '-':
                $result = $this->minus($numbers);
                break;
            case '*':
                $result = $this->multiply($numbers);
                break;
            case '/':
                $result = $this->delete($numbers);
                break;
        }
        return $result;
    }

    /**
     * Returns priority of operand
     *
     * @param string $operand
     * @return int|null
     */
    public function getPriority(string $operand) : ?int
    {
        if($priority = $this->operandPriority[$operand]) {
            return $priority;
        }
        return null;
    }

    /**
     * Plus method
     *
     * @param array $numbers
     * @return int
     */
    private function plus(array $numbers) : int
    {
        return $numbers[0] + $numbers[1];
    }

    /**
     * Minus method
     *
     * @param array $numbers
     * @return int
     */
    private function minus($numbers)
    {
        return $numbers[0] - $numbers[1];
    }

    /**
     * Multiply method
     *
     * @param array $numbers
     * @return int
     */
    private function multiply($numbers)
    {
        return $numbers[0] * $numbers[1];
    }

    /**
     * Delete method
     *
     * @param array $numbers
     * @return int
     */
    private function delete($numbers)
    {
        return $numbers[0] / $numbers[1];
    }
}