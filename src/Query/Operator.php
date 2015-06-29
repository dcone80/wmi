<?php

namespace Stevebauman\Wmi\Query;

class Operator
{
    /**
     * The equals operator.
     *
     * @var string
     */
    protected $equals = '=';

    /**
     * The less than operator.
     *
     * @var string
     */
    protected $lessThan = '<';

    /**
     * The greater than operator.
     *
     * @var string
     */
    protected $greaterThan = '>';

    /**
     * The less than or equal to operator.
     *
     * @var string
     */
    protected $lessThanEqualTo = '<=';

    /**
     * The greater than or equal to operator.
     *
     * @var string
     */
    protected $greaterThanEqualTo = '>=';

    /**
     * The wildcard operator.
     *
     * @var string
     */
    protected static $wildcard = '*';

    /**
     * The like operator.
     *
     * @var string
     */
    protected static $like = 'LIKE';

    /**
     * The is operator.
     *
     * @var string
     */
    protected static $is = 'IS';

    /**
     * The is a operator.
     *
     * @var string
     */
    protected static $isA = 'ISA';

    /**
     * The is not operator.
     *
     * @var string
     */
    protected static $isNot = 'IS NOT';
}
