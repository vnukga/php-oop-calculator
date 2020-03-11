<?php

namespace App\DataStructures;

use App\DataStructures\Exceptions\InvalidExpressionException;
use SplDoublyLinkedList;

/**
 * ArrayObject for handling items from expression
 *
 * Class ExpressionItems
 * @package App\DataStructures
 */
class ExpressionItems extends SplDoublyLinkedList
{
    private $validationPattern = '/^[0-9+()\-*\/]*$/';

    /**
     * ExpressionItems constructor.
     * @param string $expression
     * @throws InvalidExpressionException
     */
    public function __construct(string $expression)
    {
        $this->validateExpression($expression);
        $this->handleExpression($expression);
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
     * Handles expression with numbers and operands
     *
     * @param string $expression
     */
    private function handleExpression(string $expression) : void
    {
        for ($i = 0; $i < $arrayLength = strlen($expression); $i++) {
            $currentNumber = '';
            while ($this->checkIsNumeric($expression[$i])) {
                //TODO: make validators
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
     * Validates expression string
     *
     * @param string $expression
     * @throws InvalidExpressionException
     */
    private function validateExpression(string $expression) : void
    {
         if(!preg_match($this->validationPattern, $expression)) {
             throw new InvalidExpressionException();
         }
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