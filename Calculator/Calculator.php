<?php


namespace App;

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
    
    public function __construct()
    {
        $this->operation = new Operation();
    }

    /**
     * Calculates expression string
     *
     * @param string $expression
     * @return string|null
     */
    public function calculateExpression(string $expression) : ?string
    {
        $preparedArray = $this->getPreparedArray($expression);
        $numericArray = [];
        $characterArray = [];
        foreach ($preparedArray as $key => $item){
            $this->handleItem($item, $numericArray, $characterArray);
        }
        while(count($characterArray) > 0) {
            $currentOperation = array_pop($characterArray);
            $this->executeCurrentOperation($numericArray, $currentOperation);
        }
        if(count($numericArray) === 1) {
            return $numericArray[0];
        }
        return false;
    }

    /**
     * Splits expression string to array with numeric and character elements
     *
     * @param string $expression
     * @return array
     */
    private function getPreparedArray(string $expression) : array
    {
        $expressionStringAsArray = str_split($expression);
        $preparedArray = [];
        for ($i = 0; $i < $arrayLength = count($expressionStringAsArray); $i++) {
            $currentNumber = '';
            while ($this->checkIsNumeric($expressionStringAsArray[$i])) {
                $currentNumber .= $expressionStringAsArray[$i];
                if($i < $arrayLength - 1) {
                    $i++;
                } else {
                    break;
                }
            }
            if(strlen($currentNumber) > 0) {
                $preparedArray[] = $currentNumber;
            }
            if(!$this->checkIsNumeric($expressionStringAsArray[$i])) {
                $preparedArray[] = $expressionStringAsArray[$i];
            }
        }
        return $preparedArray;
    }

    /**
     * Handles splitted array item
     *
     * @param string $item
     * @param array $numericArray
     * @param array $characterArray
     * @return bool
     */
    private function handleItem(string $item, array &$numericArray, array &$characterArray) : bool
    {
        $prevCharacter = $this->getPrevCharacter($characterArray);
        if($this->checkIsNumeric($item)){
            $numericArray[] = $item;
        } else {
            if($priority = $this->operation->getPriority($item)){
                if($prevCharacter && $priority <= $this->operation->getPriority($prevCharacter)) {
                    $prevNumbers =  $this->getTwoLastNumbers($numericArray);
                    $calculatedResult = $this->operation->calculate($prevNumbers, $prevCharacter);
                    $numericArray[] = $calculatedResult;
                    array_pop($characterArray);
                }
            } elseif ($item === ')') {
                while(($currentOperation = array_pop($characterArray)) !== '(') {
                    $this->executeCurrentOperation($numericArray, $currentOperation);
                }
                return false;
            }
            $characterArray[] = $item;
        }
        return true;
    }

    /**
     * Checks is value numeric
     *
     * @param string $char
     * @return bool
     */
    private function checkIsNumeric(string $char) : bool
    {
        return preg_match('/[0-9]/', $char) ? true : false;
    }

    /**
     * Returns last value from characters array
     *
     * @param array $chars
     * @return string|null
     */
    private function getPrevCharacter(array $chars) : ?string
    {
        $length = count($chars);
        $prevCharacter = $chars[$length - 1];
        return $prevCharacter;
    }

    /**
     * Returns two last numbers from array
     *
     * @param array $numbersArray
     * @return array
     */
    private function getTwoLastNumbers(array &$numbersArray) : array
    {
        $numbers = [
            1 => array_pop($numbersArray),
            0 => array_pop($numbersArray)
        ];
        return $numbers;
    }

    /**
     * Executes arithmetic operation
     *
     * @param array $numericArray
     * @param string $operation
     */
    private function executeCurrentOperation(array &$numericArray, string $operation) : void
    {
        $numbers = $this->getTwoLastNumbers($numericArray);
        $result = $this->operation->calculate($numbers, $operation);
        $numericArray[] = $result;
    }
}