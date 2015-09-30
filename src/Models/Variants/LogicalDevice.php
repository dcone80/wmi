<?php

namespace Stevebauman\Wmi\Models\Variants;

class LogicalDevice extends ManagedSystemElement
{
    /**
     * The availability and status of the device. For example, the Availability property
     * indicates that the device is running and has full power (value=3), or is in a
     * warning (4), test (5), degraded (10) or power save state (values 13-15 and 17).
     * Regarding the power saving states, these are defined as follows: Value 13
     * ("Power Save - Unknown") indicates that the device is known to be in a
     * power save mode, but its exact status in this mode is unknown; 14
     * ("Power Save - Low Power Mode") indicates that the device is in a
     * power save state but still functioning, and may exhibit degraded
     * performance; 15 ("Power Save - Standby") describes that the device
     * is not functioning but could be brought to full power 'quickly';
     * and value 17 ("Power Save - Warning") indicates that the
     * device is in a warning state, though also in a power save mode.
     *
     * @return null|int
     */
    public function getAvailability()
    {
        return $this->variant->availability();
    }

    /**
     * DeviceID is an address or other identifying information to uniquely name the logical device.
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->variant->deviceId();
    }

    /**
     * LastErrorCode captures the last error code reported by the logical device.
     *
     * @return int
     */
    public function getLastErrorCode()
    {
        return $this->variant->lastErrorCode();
    }

    /**
     * Returns a string indicating the devices status.
     *
     * @return mixed|null
     */
    public function getStatusInfo()
    {
        $int = $this->variant->statusInfo();

        $possible = [
            1 => 'Other',
            2 => 'Unknown',
            3 => 'Enabled',
            4 => 'Disabled',
            5 => 'Not Applicable',
        ];

        return $this->getFromPossibleValues($int, $possible);
    }

    /**
     * The scoping System's Name.
     *
     * @return string
     */
    public function getSystemName()
    {
        return $this->variant->systemName();
    }
}
