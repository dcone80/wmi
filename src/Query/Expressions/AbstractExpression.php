<?php

namespace Stevebauman\Wmi\Query\Expressions;

use Stevebauman\Wmi\Exceptions\Query\InvalidOperatorException;
use Stevebauman\Wmi\Query\Operator;

abstract class AbstractExpression
{
    /**
     * Builds the expression and returns the result.
     *
     * @return mixed
     */
    abstract public function build();

    /**
     * Escapes quotes for use in an SQL query string.
     *
     * @param string $value
     *
     * @return string
     */
    public function escapeValue($value)
    {
        return addslashes(stripslashes($value));
    }

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

        if (in_array($operator, $operators)) return true;

        $message = "Operator: $operator is invalid, and cannot be used.";

        throw new InvalidOperatorException($message);
    }
}
