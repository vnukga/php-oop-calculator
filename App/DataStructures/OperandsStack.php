<?php


namespace App\DataStructures;

use SplStack;

/**
 * Stack for handling operands
 *
 * Class OperandsStack
 * @package App\DataStructures
 */
class OperandsStack extends SplStack
{
    /**
     * Returns last value from characters array
     *
     * @return string|null
     */
    public function getPrevOperand() : ?string
    {
        $length = count($this);
        return $length > 0 ? $this->top() : null;
    }
}