<?php

namespace Stevebauman\Wmi\Query\Expressions;

use Stevebauman\Wmi\Exceptions\Query\InvalidOperatorException;
use Stevebauman\Wmi\Query\Operator;

abstract class AbstractExpression
{
    /**
     * Validates the operator in an expression.
     *
     * @param string $operator
     *
     * @return bool
     *
     * @throws InvalidOperatorException
     */
    public function validateOperator($operator)
    {
        $operators = Operator::get();

        if(in_array($operator, $operators)) return true;

        $message = "Operator: $operator is invalid, and cannot be used.";

        throw new InvalidOperatorException($message);
    }
}
