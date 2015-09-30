<?php

namespace Stevebauman\Wmi\Processors;

use Stevebauman\Wmi\Models\Variants\HardDisk;
use Stevebauman\Wmi\Schemas\Classes;

class HardDisks extends AbstractProcessor
{
    /**
     * Returns an array of all hard disks on the computer.
     *
     * @return array
     */
    public function get()
    {
        $disks = [];

        $result = $this->connection->newQuery()->from(Classes::WIN32_LOGICALDISK)->get();

        foreach($result as $disk) {
            $disks[] = new HardDisk($disk);
        }

        return $disks;
    }
}
