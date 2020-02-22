<?php


namespace App;


class Calculator
{
    private $operandPriority = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2
    ];

    public function calculateExpression($expression)
    {
        $preparedArray = $this->getPreparedArray($expression);
        $numericArray = [];
        $characterArray = [];
        foreach ($preparedArray as $key => $item){
            $prevCharacter = $this->getPrevCharacter($characterArray);
            if($this->checkIsNumeric($item)){
                $numericArray[] = $item;
            } else {
                if($priority = $this->operandPriority[$item]){
                    if($prevCharacter && $priority <= $this->operandPriority[$prevCharacter]) {
                        $prevNumbers = [
                            1 => array_pop($numericArray),
                            0 => array_pop($numericArray)
                        ];
                        $calculatedResult = $this->calculate($prevNumbers, $prevCharacter);
                        $numericArray[] = $calculatedResult;
                        array_pop($characterArray);
                        $prevCharacter = $this->getPrevCharacter($characterArray);
                    }
                }
                $characterArray[] = $item;
            }
        }
        while(count($characterArray) > 0) {
            $currentOperation = array_pop($characterArray);
            $numbers = [
                1 => array_pop($numericArray),
                0 => array_pop($numericArray)
            ];
            $result = $this->calculate($numbers, $currentOperation);
            $numericArray[] = $result;
        }
        var_dump($numericArray);
        var_dump($characterArray);
    }

    private function getPrevCharacter($chars)
    {
        $length = count($chars);
        $prevCharacter = $chars[$length - 1];
        return $prevCharacter;
    }

//    private function getArrayLastElement(&$array)
//    {
//        $lastElement = array_pop($array);
//        return $lastElement;
//    }

    private function calculate($numbers, $operand)
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

    private function plus($numbers)
    {
        return $numbers[0] + $numbers[1];
    }

    private function minus($numbers)
    {
        return $numbers[0] - $numbers[1];
    }

    private function multiply($numbers)
    {
        return $numbers[0] * $numbers[1];
    }

    private function delete($numbers)
    {
        return $numbers[0] / $numbers[1];
    }

    private function getPreparedArray($expression)
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

    private function checkIsNumeric($char)
    {
        return preg_match('/[0-9]/', $char) ? true : false;
    }
}