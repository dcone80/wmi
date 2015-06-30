<?php

namespace Stevebauman\Wmi\Query\Expressions;

use Stevebauman\Wmi\Query\Operator;

class Select extends AbstractExpression
{
    /**
     * The select columns.
     *
     * @var string
     */
    protected $columns = [];

    /**
     * Constructor.
     *
     * @param array|string|null $columns
     */
    public function __construct($columns = null)
    {
        if (is_array($columns)) {
            foreach ($columns as $column) {
                $this->addColumn($column);
            }
        } elseif (is_string($columns)) {
            $this->addColumn($columns);
        } else {
            $this->addColumn(Operator::$wildcard);
        }
    }

    /**
     * Returns the built select expression.
     *
     * @return string
     */
    public function build()
    {
        $columns = implode(', ', $this->columns);

        return sprintf('SELECT %s', $columns);
    }

    /**
     * Adds a column to the select expression.
     *
     * @param string $column
     *
     * @return $this
     */
    private function addColumn($column)
    {
        $this->columns[] = $column;

        return $this;
    }
}
