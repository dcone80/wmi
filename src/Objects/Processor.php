<?php

namespace Stevebauman\Wmi\Objects;

class Processor extends LogicalDevice
{
    /**
     * Returns the processor architecture.
     *
     * @return null|string
     */
    public function getArchitecture()
    {
        $int = $this->variant->architecture();

        switch($int) {
            case 0:
                return 'x86';
            case 1:
                return 'MIPS';
            case 2:
                return 'Alpha';
            case 3:
                return 'PowerPC';
            case 6:
                return 'ia64';
            case 9:
                return 'x64';
        }

        return null;
    }
}
