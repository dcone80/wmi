<?php

namespace Stevebauman\Wmi\Query;

use Stevebauman\Wmi\ConnectionInterface;

interface BuilderInterface
{
    public function __construct(ConnectionInterface $connection);

    public function select($columns);

    public function where($column, $operator, $value);

    public function orWhere($column, $operator, $value);
}
