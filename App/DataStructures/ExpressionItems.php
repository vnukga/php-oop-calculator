<?php

namespace App\DataStructures;

use SplDoublyLinkedList;

/**
 * ArrayObject for handling items from expression
 *
 * Class ExpressionItems
 * @package App\DataStructures
 */
class ExpressionItems extends SplDoublyLinkedList
{
    /**
     * Handles expression with numbers and operands
     *
     * ExpressionItems constructor.
     * @param string $expression
     */
    public function __construct(string $expression)
    {
        for ($i = 0; $i < $arrayLength = strlen($expression); $i++) {
            $currentNumber = '';
            while ($this->checkIsNumeric($expression[$i])) {
                $currentNumber .= $expression[$i];
                if($i < $arrayLength - 1) {
                    $i++;
                } else {
                    break;
                }
            }
            if(strlen($currentNumber) > 0) {
                $this->push($currentNumber);
            }
            if(!$this->checkIsNumeric($expression[$i])) {
                $this->push($expression[$i]);
            }
        }
    }

    /**
     * Checks if current item is numeric
     *
     * @return bool
     */
    public function isCurrentItemNumeric() : bool
    {
        return $this->checkIsNumeric($this->current());
    }

    /**
     * Checks if value is numeric
     *
     * @param string $char
     * @return bool
     */
    private function checkIsNumeric(string $char) : bool
    {
        return preg_match('/[0-9]/', $char);
    }
}