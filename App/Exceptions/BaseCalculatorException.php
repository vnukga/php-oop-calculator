<?php


namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class BaseCalculatorException
 * @package App\Exceptions
 */
class BaseCalculatorException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if(strlen($message) == 0){
            $message = 'Invalid expression!';
        }
        parent::__construct($message, $code, $previous);
    }
}