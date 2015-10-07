<?php

namespace Stevebauman\Wmi\Models\Variants;

class HardDisk extends LogicalDevice
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
     * The MediaType property indicates the type of media currently present in the logical drive.
     * This value will be one of the values of the MEDIA_TYPE enumeration defined in winioctl.h.
     *
     * Note: The value may not be exact for removable drives if currently there is no media in the drive.
     *
     * @return int
     */
    public function getMediaType()
    {
        return $this->variant->mediaType();
    }

    /**
     * The ProviderName property indicates the network path name to the logical device.
     *
     * @return string
     */
    public function getProviderName()
    {
        return $this->variant->providerName();
    }

    /**
     * The QuotasDisabled property indicates that Quota management is not enabled on this volume.
     *
     * @return bool
     */
    public function getQuotasDisabled()
    {
        return $this->variant->quotasDisabled();
    }

    /**
     * The QuotasIncomplete property indicates that Quota management was
     * used but has been disabled. Incomplete refers to the
     * information left in the file system after quota
     * management has been disabled.
     *
     * @return bool
     */
    public function getQuotasIncomplete()
    {
        return $this->variant->quotasIncomplete();
    }

    /**
     * The QuotasRebuilding property indicates an active state signifying
     * that the file system is in process of compiling information
     * and setting the disk up for quota management.
     *
     * @return bool
     */
    public function getQuotasRebuilding()
    {
        return $this->variant->quotasRebuilding();
    }

    /**
     * The SupportsDiskQuotas property indicates whether this volume supports disk Quotas.
     *
     * @return bool
     */
    public function getSupportsDiskQuotas()
    {
        return $this->variant->supportsDiskQuotas();
    }

    /**
     * The SupportsFileBasedCompression property indicates whether the logical
     * disk partition supports file based compression, such as is the case
     * with NTFS. This property is FALSE, when the Compressed property is TRUE.
     *
     * Values: TRUE or FALSE. If TRUE, the logical disk supports file based compression.
     *
     * @return bool
     */
    public function getSupportsFileBasedCompression()
    {
        return $this->variant->supportsFileBasedCompression();
    }

    /**
     * The VolumeDirty property indicates whether the disk requires chkdsk to be run at
     * next boot up time. The property is applicable to only those instances of logical
     * disk that represent a physical disk in the machine. It is not applicable to
     * mapped logical drives.
     *
     * @return bool
     */
    public function getVolumeDirty()
    {
        return $this->variant->volumeDirty();
    }

    /**
     * The VolumeName property indicates the volume name of the logical disk.
     *
     * Constraints: Maximum 32 characters
     *
     * @return string
     */
    public function getVolumeName()
    {
        return $this->variant->volumeName();
    }

    /**
     * The VolumeSerialNumber property indicates the volume serial number of the logical disk.
     *
     * Constraints: Maximum 11 characters
     *
     * Example: A8C3-D032
     *
     * @return string
     */
    public function getVolumeSerialNumber()
    {
        return $this->variant->volumeSerialNumber();
    }

    /**
     * The Size property indicates in bytes, the size of the logical disk.
     *
     * The integer returned is in bytes.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->variant->size();
    }

    /**
     * The FreeSpace property indicates in bytes how much free space is available on the logical disk.
     *
     * The integer returned is in bytes.
     *
     * @return int
     */
    public function getFreeSpace()
    {
        return $this->variant->freeSpace();
    }

    /**
     * Invokes the Chkdsk operation on the current volume.
     *
     * @param bool|false $fixErrors If true, errors found on the disk are fixed. The default is false.
     * @param bool|true  $vigorousIndexCheck If true, a vigorous check of index entries is performed. The default is true.
     * @param bool|true  $skipFolderCycle If true, the folder cycle checking should be skipped. The default is true.
     * @param bool|false $forceDismount If true, the volume is dismounted before checking. The default is false.
     * @param bool|false $recoverBadSectors If true, the bad sectors are located and the readable information is recovered. The default is false.
     * @param bool|false $runAtBootup If true, the Chkdsk operation is performed at the next boot up. The default is false.
     *
     * @return bool
     */
    public function checkDisk($fixErrors = false, $vigorousIndexCheck = true, $skipFolderCycle = true, $forceDismount = false, $recoverBadSectors = false, $runAtBootup = false)
    {
        $result = $this->variant->chkdsk($fixErrors, $vigorousIndexCheck, $skipFolderCycle, $forceDismount, $recoverBadSectors, $runAtBootup);

        switch($result) {
            case 0:
                return true;
            case 1:
                return true;
        }

        return false;
    }
}
