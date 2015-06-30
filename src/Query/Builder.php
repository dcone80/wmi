<?php

namespace Stevebauman\Wmi\Query;

use Stevebauman\Wmi\Query\Expressions\From;
use Stevebauman\Wmi\Query\Expressions\Where;
use Stevebauman\Wmi\Query\Expressions\Select;
use Stevebauman\Wmi\ConnectionInterface;

class Builder implements BuilderInterface
{
    /**
     * The select statements of the current query.
     *
     * @var Select
     */
    protected $select;

    /**
     * The from statement of the current query.
     *
     * @var From
     */
    protected $from;

    /**
     * The where statements of the current query.
     *
     * @var array
     */
    protected $wheres = [];

    /**
     * The current connection.
     *
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Adds columns to the select query statement.
     *
     * @param array|string $columns
     *
     * @return $this
     */
    public function select($columns)
    {
        $this->select = new Select($columns);

        return $this;
    }

    /**
     * Adds a where expression to the current query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed  $value
     *
     * @return $this
     */
    public function where($column, $operator, $value = null)
    {
        if(count($this->wheres) > 0) {
            $this->andWhere($column, $operator, $value);
        }

        $this->addWhere(new Where($column, $operator, $value));

        return $this;
    }

    /**
     * Adds an and where expression to the current query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed  $value
     *
     * @return $this
     */
    public function andWhere($column, $operator, $value = null)
    {
        $this->addWhere(new Where($column, $operator, $value, 'AND'));

        return $this;
    }

    /**
     * Adds a or where statement to the current query.
     *
     * @param $column
     * @param $operator
     * @param mixed $value
     *
     * @return $this
     */
    public function orWhere($column, $operator, $value = null)
    {
        $this->addWhere(new Where($column, $operator, $value, 'OR'));

        return $this;
    }

    /**
     * Adds a from statement to the current query.
     *
     * @param string $namespace
     *
     * @return $this
     */
    public function from($namespace)
    {
        $this->from = new From($namespace);

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
        $query = $this->buildQuery();

        return $this->connection->query($query);
    }

    /**
     * Returns the current query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->buildQuery();
    }

    /**
     * Adds a Where expression to the current query.
     *
     * @param Where $where
     *
     * @return $this
     */
    private function addWhere(Where $where)
    {
        $this->wheres[] = $where;

        return $this;
    }

    /**
     * Builds the query and returns the query string.
     *
     * @return string
     */
    private function buildQuery()
    {
        $select = $this->select->build();

        $from = $this->from->build();

        $wheres = $this->buildWheres();

        $query = sprintf('%s %s %s', $select, $from, $wheres);

        return trim($query);
    }

    /**
     * Builds the wheres on the current query
     * and returns the result query string.
     *
     * @return bool|string
     */
    private function buildWheres()
    {
        $whereString = '';

        $orWheresString = '';

        $andWheresString = '';

        if(count($this->wheres) > 0) {
            foreach($this->wheres as $where)
            {
                $built = $where->build();

                if($where->isAnd()) {
                    $andWheresString = sprintf('%s %s', $andWheresString, $built);
                } else if($where->isOr()) {
                    $orWheresString = sprintf('%s %s', $orWheresString, $built);
                } else {
                    $whereString = $built;
                }
            }
        }

        return sprintf('%s %s %s', $whereString, $andWheresString, $orWheresString);
    }
}
