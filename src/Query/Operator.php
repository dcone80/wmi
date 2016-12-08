<?php

namespace Stevebauman\Wmi\Query;

use ReflectionClass;

class Operator
{
    /**
     * The equals operator.
     *
     * @var string
     */
    public static $equals = '=';

    /**
     * The less than operator.
     *
     * @var string
     */
    public static $lessThan = '<';

    /**
     * The greater than operator.
     *
     * @var string
     */
    public static $greaterThan = '>';

    /**
     * The less than or equal to operator.
     *
     * @var string
     */
    public static $lessThanEqualTo = '<=';

    /**
     * The greater than or equal to operator.
     *
     * @var string
     */
    public static $greaterThanEqualTo = '>=';

    /**
     * The does not equal operator.
     *
     * @var string
     */
    public static $doesNotEqual = '!=';

    /**
     * The does not equal alternate operator.
     *
     * @var string
     */
    public static $doesNotEqualAlt = '<>';

    /**
     * The wildcard operator.
     *
     * @var string
     */
    public static $wildcard = '*';

    /**
     * The like operator.
     *
     * @var string
     */
    public static $like = 'like';

    /**
     * The is operator.
     *
     * @var string
     */
    public static $is = 'is';

    /**
     * The is a operator.
     *
     * @var string
     */
    public static $isA = 'isa';

    /**
     * The is not operator.
     *
     * @var string
     */
    public static $isNot = 'is not';

    /**
     * Returns all available operators.
     *
     * @return array
     */
    public static function get()
    {
        $reflection = new ReflectionClass(new Operator());

        return array_values($reflection->getStaticProperties());
    }
}
