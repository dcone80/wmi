<?php

namespace Stevebauman\Wmi\Processors;

use Stevebauman\Wmi\Processors\Registry;

class Software extends AbstractProcessor
{
    /**
     * The Registry processor instance.
     *
     * @var Registry
     */
    protected $registry;

    /**
     * The registry software path.
     *
     * @var string
     */
    protected $path = 'SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Uninstall\\';

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        $this->registry = $this->connection->registry();
    }

    /**
     * Returns an array of software on the current computer.
     *
     * @return array
     */
    public function get()
    {
        $keys = $this->registry
            ->setRoot(Registry::HKEY_LOCAL_MACHINE)
            ->setPath($this->path)
            ->get();

        $software = [];

        foreach ($keys as $key) {
            $path = $this->path.$key;

            $name = $this->registry->setPath($path)->getValue('DisplayName');

            if ($name) {
                $software[] = [
                    'name' => $name,
                    'version' => $this->registry->getValue('DisplayVersion'),
                    'publisher' => $this->registry->getValue('Publisher'),
                    'InstallDate' => $this->registry->getValue('InstallDate'),
                ];
            }
        }

        return $software;
    }
}
