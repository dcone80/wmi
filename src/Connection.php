<?php

namespace Stevebauman\Wmi;

use Stevebauman\Wmi\Processors\HardDisks;
use Stevebauman\Wmi\Processors\Processors;
use Stevebauman\Wmi\Processors\Registry;
use Stevebauman\Wmi\Processors\Software;
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
     * Returns a new Registry processor instance.
     *
     * @return Registry
     */
    public function registry()
    {
        return new Registry($this);
    }

    /**
     * Returns a new Software processor instance.
     *
     * @return Software
     */
    public function software()
    {
        return new Software($this);
    }

    /**
     * Returns a new Processors processor instance.
     *
     * @return Processors
     */
    public function processors()
    {
        return new Processors($this);
    }

    /**
     * Returns a new HardDisks processor instance.
     *
     * @return HardDisks
     */
    public function hardDisks()
    {
        return new HardDisks($this);
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
