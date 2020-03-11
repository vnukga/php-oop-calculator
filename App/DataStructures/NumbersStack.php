<?php


namespace App\DataStructures;

use App\DataStructures\Exceptions\EmptyStackException;
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
     * @throws EmptyStackException
     */
    public function getTwoLastNumbers() : array
    {
        if(count($this) < 2) {
            throw new EmptyStackException('Trying to read a non-existing number from stack!');
        }
        $numbers = [
            1 => $this->pop(),
            0 => $this->pop()
        ];
        return $numbers;
    }
}