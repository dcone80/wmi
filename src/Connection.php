<?php

namespace Stevebauman\Wmi;

use Stevebauman\Wmi\Objects\HardDisk;
use Stevebauman\Wmi\Objects\Processor;
use Stevebauman\Wmi\Schemas\Classes;
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
     * Returns an array of processors on the current computer.
     *
     * @return array
     */
    public function getProcessors()
    {
        $processors = [];

        $result = $this->newQuery()->from(Classes::WIN32_PROCESSOR)->get();

        foreach($result as $processor) {
            $processor[] = new Processor($processor);
        }

        return $processors;
    }

    /**
     * Returns an array of hard disks on the current computer.
     *
     * @return array
     */
    public function getHardDisks()
    {
        $disks = [];

        $result = $this->newQuery()->from(Classes::WIN32_LOGICALDISK)->get();

        foreach($result as $disk) {
            $disks[] = new HardDisk($disk);
        }

        return $disks;
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
