<?php

namespace Stevebauman\Wmi\Query;

use Stevebauman\Wmi\ConnectionInterface;

class Builder
{
    /**
     * The select statements of the current query.
     *
     * @var array
     */
    protected $selects = [];

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



}
