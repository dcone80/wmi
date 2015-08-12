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
}
