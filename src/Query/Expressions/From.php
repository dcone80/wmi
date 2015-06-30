<?php

namespace Stevebauman\Wmi\Query\Expressions;

class From extends AbstractExpression
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

    /**
     * Returns the from statement.
     *
     * @return string
     */
    public function build()
    {
        return sprintf('FROM %s', $this->namespace);
    }
}
