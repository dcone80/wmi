<?php

namespace Stevebauman\Wmi\Processors;

use Stevebauman\Wmi\ConnectionInterface;

abstract class AbstractProcessor
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Constructor.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;

        $this->boot();
    }

    /**
     * Run boot operations on construct.
     */
    public function boot()
    {
        //
    }
}
