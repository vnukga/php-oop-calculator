<?php

use PHPUnit\Framework\TestCase;
use App\Calculator;


class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp() : void
    {
        $this->calculator = new Calculator();
    }

    protected function tearDown() : void
    {
        $this->calculator = NULL;
    }

    public function testCalculateValidExpression()
    {
        $expression = '1+1*(1-1/(1+1))';
        $result = 1.5;
        $calculatedResult = $this->calculator->calculateExpression($expression);
        $this->assertEquals($result, $calculatedResult);
    }

    public function testCalculateInvalidExpression()
    {
        $expression = '1+1*(1+1*(1+1.1))';
        $calculatedResult = $this->calculator->calculateExpression($expression);
        $this->assertNull($calculatedResult);
    }

    public function testCalculateExpressionWithDivisionByZero()
    {
        $expression = '1+1*(1+1*(1+1/0))';
        $calculatedResult = $this->calculator->calculateExpression($expression);
        $this->assertNull($calculatedResult);
    }
}