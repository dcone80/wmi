<?php

namespace Stevebauman\Wmi\Processors;

use Variant;

class Registry extends AbstractProcessor
{
    const HKEY_CLASSES_ROOT = 0x80000000;

    const HKEY_CURRENT_USER = 0x80000001;

    const HKEY_LOCAL_MACHINE = 0x80000002;

    const HKEY_USERS = 0x80000003;

    const HKEY_CURRENT_CONFIG = 0x80000005;

    /**
     * The binary root registry path to browse.
     *
     * @var int
     */
    protected $root = self::HKEY_LOCAL_MACHINE;

    /**
     * The registry path to browse.
     *
     * @var string
     */
    protected $path = '';

    /**
     * The registry provider variant.
     *
     * @var Variant
     */
    protected $provider;

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        $connection = $this->connection->get();

        $this->provider = $connection->get('StdRegProv');
    }

    /**
     * Returns the list of keys available from the registry.
     *
     * @return array
     */
    public function get()
    {
        $this->provider->enumKey($this->root, $this->path, $keys = new Variant());

        $formatted = [];

        $i = 0;

        foreach($keys as $key) {
            $formatted[$i] = $key;

            $i++;
        }

        return $formatted;
    }

    /**
     * Returns the value of a specific key in the current
     * root and path of the registry.
     *
     * @param string $key
     *
     * @return string
     */
    public function getValue($key)
    {
        $status = $this->provider->getStringValue($this->root, $this->path, $key, $value = new Variant());

        if($status === 0) {
            return (string) $value;
        }

        return null;
    }

    /**
     * Sets the root registry path to browse.
     *
     * @param int $path
     *
     * @return Registry
     */
    public function setRoot($path)
    {
        $this->root = (int) $path;

        return $this;
    }

    /**
     * Sets the registry path to browse.
     *
     * @param string $path
     *
     * @return Registry
     */
    public function setPath($path)
    {
        $this->path = (string) $path;

        return $this;
    }

    /**
     * Returns the root path of the registry.
     *
     * @return int
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Returns the registry path to browse.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
