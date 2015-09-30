<?php

namespace Stevebauman\Wmi\Models;

class AbstractModel
{
    /**
     * The models attributes.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Retrieves a value from the specified
     * key on the models attributes array.
     *
     * @param int|string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    /**
     * Sets the specified key on the attributes
     * array to the specified value.
     *
     * @param int|string $key
     * @param mixed      $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }
}
