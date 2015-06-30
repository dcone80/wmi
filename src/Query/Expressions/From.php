<?php

namespace Stevebauman\Wmi\Query\Expressions;

class From extends Expression
{
    /**
     * The namespace to perform the query on.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Constructor.
     *
     * @param string $namespace
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }
}
