<?php

namespace Stevebauman\Wmi\Query\Expressions;

class Where extends AbstractExpression
{
    /**
     * The column for the where clause.
     *
     * @var string
     */
    protected $column;

    /**
     * The operator for the where clause.
     *
     * @var string
     */
    protected $operator;

    /**
     * The value for the where clause.
     *
     * @var mixed
     */
    protected $value = null;

    /**
     * The keyword of the where clause.
     *
     * @var string
     */
    protected $keyword = null;

    /**
     * Constructor.
     *
     * @param string $column
     * @param string $operator
     * @param mixed  $value
     * @param string $keyword
     *
     * @throws \Stevebauman\Wmi\Exceptions\Query\InvalidOperatorException
     */
    public function __construct($column, $operator, $value = null, $keyword = null)
    {
        if(is_null($value)) {
            /*
             * If the value is null, we're going to assume
             * they want a where equals expression.
             */
            $this->operator = '=';
            $this->value = $operator;
        } else {
            /*
             * If they've supplied a value then we'll
             * validate the operator before proceeding.
             */
            if($this->validateOperator($operator)) {
                $this->operator = $operator;
                $this->value = $value;
            }
        }

        $this->column = $column;
    }

    /**
     * Builds the current where expression and returns the result.
     *
     * @return string
     */
    public function build()
    {
        $where = sprintf('WHERE %s %s %s', $this->column, $this->operator, $this->value);

        if(!is_null($this->keyword)) {
            $where = sprintf('%s %s', $this->keyword, $where);
        }

        return $where;
    }

    /**
     * Returns true / false if the current
     * where expression is an and.
     *
     * @return bool
     */
    public function isAnd()
    {
        return ($this->keyword === 'AND' ? true : false);
    }

    /**
     * Returns true / false if the current
     * where expression is an or.
     *
     * @return bool
     */
    public function isOr()
    {
        return ($this->keyword === 'OR' ? true : false);
    }
}
