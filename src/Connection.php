<?php

namespace Stevebauman\Wmi;

use Stevebauman\Wmi\Query\Builder;

class Connection implements ConnectionInterface
{
    /**
     * The current connection.
     *
     * @var mixed
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param mixed $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Returns the current raw COM connection.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->connection;
    }

    /**
     * Executes the specified query on the current connection.
     *
     * @param string $query
     *
     * @return mixed
     */
    public function query($query)
    {
        return $this->connection->ExecQuery($query);
    }

    /**
     * Returns a new query builder instance.
     *
     * @return Builder
     */
    public function newQuery()
    {
        return new Builder($this);
    }
}
