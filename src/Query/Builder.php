<?php

namespace Stevebauman\Wmi\Query;

use Stevebauman\Wmi\ConnectionInterface;

class Builder
{
    /**
     * The columns to select.
     *
     * @var array
     */
    public $columns = ['*'];

    /**
     * The from expression of the query.
     *
     * @var string
     */
    public $from;

    /**
     * The within expression.
     *
     * @var string
     */
    public $within;

    /**
     * The where expressions.
     *
     * @var array
     */
    public $wheres = [];

    /**
     * The current connection.
     *
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * The WQL grammar.
     *
     * @var Grammar
     */
    protected $grammar;

    /**
     * Constructor.
     *
     * @param ConnectionInterface $connection
     * @param Grammar|null        $grammar
     */
    public function __construct(ConnectionInterface $connection, Grammar $grammar = null)
    {
        $this->connection = $connection;
        $this->grammar = $grammar ?: new Grammar();
    }

    /**
     * Set the columns to be selected.
     *
     * @param array|mixed $columns
     *
     * @return Builder
     */
    public function select($columns = ['*'])
    {
        $this->columns = is_array($columns) ? $columns : func_get_args();

        return $this;
    }

    /**
     * Adds a within expression to the current query.
     *
     * @param int $interval
     *
     * @return Builder
     */
    public function within($interval)
    {
        $this->within = $interval;

        return $this;
    }

    /**
     * Adds a where expression to the current query.
     *
     * @param array|string $field
     * @param string|null  $operator
     * @param mixed        $value
     * @param string       $boolean
     *
     * @return Builder
     */
    public function where($field, $operator = null, $value = null, $boolean = 'and')
    {
        if (is_array($field)) {
            // If the column is an array, we will assume it is an array of
            // key-value pairs and can add them each as a where clause.
            foreach ($field as $key => $value) {
                $this->where($key, Operator::$equals, $value, $boolean);
            }

            return $this;
        }

        if (!in_array($operator, Operator::get())) {
            throw new InvalidOperatorException("Invalid operator {$operator}");
        }

        $this->wheres[] = compact('field', 'operator', 'value', 'boolean');

        return $this;
    }

    /**
     * Adds an orWhere expression to the current query.
     *
     * @param array|string $field
     * @param string|null  $operator
     * @param mixed        $value
     *
     * @return Builder
     */
    public function orWhere($field, $operator = null, $value = null)
    {
        return $this->where($field, $operator, $value, 'or');
    }

    /**
     * Adds a from statement to the current query.
     *
     * This must be a WMI class.
     *
     * @param string $class
     *
     * @return Builder
     */
    public function from($class)
    {
        $this->from = $class;

        return $this;
    }

    /**
     * Builds and executes the current
     * query, returning the results.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->connection->query($this->getQuery());
    }

    /**
     * Returns a new Builder instance.
     *
     * @return Builder
     */
    public function newInstance()
    {
        return new self($this->connection, $this->grammar);
    }

    /**
     * Returns the current query.
     *
     * @throws InvalidFromStatementException
     *
     * @return string
     */
    public function getQuery()
    {
        if (empty($this->from)) {
            throw new InvalidFromStatementException("You must provide a 'from' statement.");
        }

        return $this->grammar->compile($this);
    }
}
