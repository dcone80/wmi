<?php

namespace Stevebauman\Wmi\Models\Variants;

class ManagedSystemElement extends AbstractModel
{
    /**
     * Returns the objects name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->variant->name();
    }

    /**
     * The Description property provides a textual description of the object.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->variant->description();
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
     * The Status property is a string indicating the current status of the object. Various
     * operational and non-operational statuses can be defined. Operational statuses
     * are "OK", "Degraded" and "Pred Fail". "Pred Fail" indicates that an element
     * may be functioning properly but predicting a failure in the near future. An
     * example is a SMART-enabled hard drive. Non-operational statuses can also be
     * specified. These are "Error", "Starting", "Stopping" and "Service".
     * The latter, "Service", could apply during mirror-resilvering of a disk,
     * reload of a user permissions list, or other administrative work.
     * Not all such work is on-line, yet the managed element is neither
     * "OK" nor in one of the other states.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->variant->status();
    }

    /**
     * The InstallDate property is datetime value indicating when the object was
     * installed. A lack of a value does not indicate that the object is not installed.
     *
     * @return null|\DateTime
     */
    public function getInstallDate()
    {
        return $this->variant->installdate();
    }
}
