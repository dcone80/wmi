<?php

namespace Stevebauman\Wmi\Query\Expressions;

class Within extends AbstractExpression
{
    /**
     * The interval of the within expression.
     *
     * @var int
     */
    protected $interval = 10;

    /**
     * Constructor.
     *
     * @param int $interval
     */
    public function __construct($interval)
    {
        $this->interval = (int) $interval;
    }

    /**
     * Returns the built within expression string.
     *
     * @return string
     */
    public function build()
    {
        return sprintf(' WITHIN %s', $this->interval);
    }
}
