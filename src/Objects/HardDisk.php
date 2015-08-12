<?php

namespace Stevebauman\Wmi\Objects;

class HardDisk extends AbstractObject
{
    /**
     * Access describes whether the media is readable (value=1),
     * writeable (value=2), or both (value=3). "Unknown" (0)
     * and "Write Once" (4) can also be defined.
     *
     * @return int
     */
    public function getAccess()
    {
        return $this->variant->access();
    }

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
     * Size in bytes of the blocks which form this StorageExtent. If variable block
     * size, then the maximum block size in bytes should be specified. If the block
     * size is unknown or if a block concept is not valid (for example, for
     * Aggregate Extents, Memory or LogicalDisks), enter a 1.
     *
     * @return null|int
     */
    public function getBlockSize()
    {
        return $this->variant->blocksize();
    }

    /**
     * The Caption property is a short textual description (one-line string) of the object.
     *
     * @return null|string
     */
    public function getCaption()
    {
        return $this->variant->caption();
    }

    /**
     * The Compressed property indicates whether the logical volume exists as a
     * single compressed entity, such as a DoubleSpace volume. If file
     * based compression is supported (such as on NTFS), this
     * property will be FALSE.
     *
     * @return bool
     */
    public function getCompressed()
    {
        return $this->variant->compressed();
    }

    /**
     * The DriveType property contains a numeric value corresponding to the type of disk
     * drive this logical disk represents. Please refer to the Platform SDK
     * documentation for additional values.
     *
     * Example: A CD-ROM drive would return 5.
     *
     * @return int
     */
    public function getDriveType()
    {
        return $this->variant->drivetype();
    }

    /**
     * The FileSystem property indicates the file system on the logical disk.
     *
     * Example: NTFS
     *
     * @return string
     */
    public function getFileSystem()
    {
        return $this->variant->filesystem();
    }

    /**
     * Returns the hard disks name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->variant->name();
    }
}
