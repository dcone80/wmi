<?php

namespace Stevebauman\Wmi\Objects;

class AbstractObject
{
    /**
     * The variant object.
     *
     * @var object
     */
    protected $variant;

    /**
     * Constructor.
     *
     * @param object $variant
     */
    public function __construct($variant)
    {
        $this->variant = $variant;
    }

    /**
     * Returns the variant object.
     *
     * @return object
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Returns the possible value from the specified value
     * key if it exists in the possible array.
     *
     * @param int|string $value
     * @param array      $possible
     *
     * @return null|mixed
     */
    protected function getFromPossibleValues($value, $possible = [])
    {
        if(array_key_exists($value, $possible)) {
            return $possible[$value];
        }

        return null;
    }
}
