<?php

namespace Stevebauman\Wmi;

interface ConnectionInterface
{
    /**
     * Returns the current raw connection.
     *
     * @return mixed
     */
    public function get();

    /**
     * Returns a new Registry instance.
     *
     * @return \Stevebauman\Wmi\Processors\Registry
     */
    public function registry();

    /**
     * Returns a new Processors instance.
     *
     * @return \Stevebauman\Wmi\Processors\Processors
     */
    public function processors();

    /**
     * Returns a new HardDisks instance.
     *
     * @return \Stevebauman\Wmi\Processors\HardDisks
     */
    public function hardDisks();

    /**
     * Returns a new QueryBuilder instance.
     *
     * @return \Stevebauman\Wmi\Query\Builder
     */
    public function newQuery();

    /**
     * Runs the specified raw query on the current
     * connection and returns the result.
     *
     * @param string $query
     *
     * @return mixed
     */
    public function query($query);
}
