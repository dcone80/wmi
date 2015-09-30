<?php

namespace Stevebauman\Wmi\Models\Variants;

class AbstractModel
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
     * Returns the variants specified attribute.
     *
     * @param $attribute
     *
     * @return mixed
     */
    public function __get($attribute)
    {
        return $this->variant->{$attribute};
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
