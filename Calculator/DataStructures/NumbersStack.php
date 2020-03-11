<?php


namespace App\DataStructures;

use SplStack;

/**
 * Stack for handling numbers
 *
 * Class NumbersStack
 * @package App\DataStructures
 */
class NumbersStack extends SplStack
{
    /**
     * Returns two last numbers from stack
     *
     * @return array
     */
    public function getTwoLastNumbers() : array
    {
        $numbers = [
            1 => $this->pop(),
            0 => $this->pop()
        ];
        return $numbers;
    }
}