<?php


namespace App;

use App\DataStructures\ExpressionItems;
use App\DataStructures\NumbersStack;
use App\DataStructures\OperandsStack;
use App\Exceptions\BaseCalculatorException;
use App\Math\Operation;

/**
 * Class Calculator
 * Provides expression's calculating
 *
 * @package App
 */
class Calculator
{
    /**
     * Operation object
     *
     * @var Operation
     */
    private $operation;

    /**
     * Stack with numeric items
     *
     * @var NumbersStack
     */
    private $numbersStack;

    /**
     * Stack with operands
     *
     * @var OperandsStack
     */
    private $operandsStack;
    
    public function __construct()
    {
        $this->operation = new Operation();
        $this->numbersStack = new NumbersStack();
        $this->operandsStack = new OperandsStack();
    }

    /**
     * Calculates expression string
     *
     * @param string $expression
     * @return string|null
     */
    public function calculateExpression(string $expression) : ?string
    {
        try {
            $expressionItems = new ExpressionItems($expression);
            foreach ($expressionItems as $key => $item){
                $this->handleItem($item, $expressionItems->isCurrentItemNumeric());
            }
            while(count($this->operandsStack) > 0) {
                $currentOperation = $this->operandsStack->pop();
                $this->executeCurrentOperation($currentOperation);
            }
            if(count($this->numbersStack) === 1) {
                return $this->numbersStack->pop();
            }
        } catch (BaseCalculatorException $exception) {
            echo $exception->getMessage();
            return false;
        }
        return false;
    }

    /**
     * Handles expression's item
     *
     * @param string $item
     * @param bool $isNumeric
     * @return bool
     * @throws Math\Exceptions\InvalidOperationException
     */
    private function handleItem(string $item, bool $isNumeric) : bool
    {
        if($isNumeric){
            $this->numbersStack->push($item);
        } else {
            return $this->handleOperandItem($item);
        }
        return true;
    }

    /**
     * Handles operand item
     *
     * @param string $operand
     * @return bool
     * @throws Math\Exceptions\InvalidOperationException
     */
    private function handleOperandItem(string $operand) : bool
    {
        $prevOperand = $this->operandsStack->getPrevOperand();
        if($this->operation->compareOperandsPriority($operand, $prevOperand)) {
            $this->executeCurrentOperation($prevOperand);
            $this->operandsStack->pop();
        } elseif ($operand === ')') {
            while(($currentOperation = $this->operandsStack->pop()) !== '(') {
                $this->executeCurrentOperation($currentOperation);
            }
            return false;
        }
        $this->operandsStack->push($operand);
        return true;
    }

    /**
     * Executes arithmetic operation
     *
     * @param string $operation
     * @throws Math\Exceptions\InvalidOperationException
     */
    private function executeCurrentOperation(string $operation) : void
    {
        $numbers = $this->numbersStack->getTwoLastNumbers();
        $result = $this->operation->calculate($numbers, $operation);
        $this->numbersStack->push($result);
    }
}