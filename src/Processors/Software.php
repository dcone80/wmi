<?php

namespace Stevebauman\Wmi\Processors;

use Stevebauman\Wmi\Models\Application;

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
            // Set a new temporary path for the software key
            $path = $this->path.$key;

            // Retrieve the name of the software
            $name = $this->registry->setPath($path)->getValue('DisplayName');

            // If the name exists, we'll retrieve the rest of the software information
            if ($name) {
                $software[] = new Application([
                    'name' => $name,
                    'version' => $this->registry->getValue('DisplayVersion'),
                    'publisher' => $this->registry->getValue('Publisher'),
                    'install_date' => $this->registry->getValue('InstallDate'),
                ]);
            }
        }

        return $software;
    }
}
