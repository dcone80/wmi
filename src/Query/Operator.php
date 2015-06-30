<?php

namespace Stevebauman\Wmi\Query;

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
    public static $like = 'LIKE';

    /**
     * The is operator.
     *
     * @var string
     */
    public static $is = 'IS';

    /**
     * The is a operator.
     *
     * @var string
     */
    public static $isA = 'ISA';

    /**
     * The is not operator.
     *
     * @var string
     */
    public static $isNot = 'IS NOT';

    /**
     * Returns all available operators.
     *
     * @return array
     */
    public static function get()
    {
        return [
            self::$equals,
            self::$lessThan,
            self::$lessThanEqualTo,
            self::$greaterThan,
            self::$greaterThanEqualTo,
            self::$doesNotEqual,
            self::$doesNotEqualAlt,
            self::$is,
            self::$isA,
            self::$isNot,
            self::$like,
        ];
    }
}
