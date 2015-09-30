<?php

namespace Stevebauman\Wmi\Models\Variants;

class Processor extends LogicalDevice
{
    /**
     * Processor address width in bits.
     *
     * @return int
     */
    public function getAddressWidth()
    {
        return $this->variant->addressWidth();
    }

    /**
     * Returns the processor architecture.
     *
     * @return null|string
     */
    public function getArchitecture()
    {
        $int = $this->variant->architecture();

        $possible = [
            0 => 'x86',
            1 => 'MIPS',
            2 => 'Alpha',
            3 => 'PowerPC',
            6 => 'ia64',
            9 => 'x64',
        ];

        return $this->getFromPossibleValues($int, $possible);
    }

    /**
     * The current speed (in MHz) of this processor.
     *
     * @return int
     */
    public function getCurrentClockSpeed()
    {
        return $this->variant->currentClockSpeed();
    }

    /**
     * The CpuStatus property specifies the current status of the
     * processor. Changes in status arise from processor usage,
     * not the physical condition of the processor.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->variant->cpuStatus();
    }

    /**
     * The LoadPercentage property specifies each processor's load
     * capacity averaged over the last second. The term 'processor
     * loading' refers to the total computing burden each
     * processor carries at one time.
     *
     * @return int
     */
    public function getLoadPercentage()
    {
        return $this->variant->loadPercentage();
    }

    /**
     * The Manufacturer property specifies the name of the processor's manufacturer.
     *
     * Example: GenuineSilicon
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->variant->manufacturer();
    }

    /**
     * The maximum speed (in MHz) of this processor.
     *
     * @return int
     */
    public function getMaxClockSpeed()
    {
        return $this->variant->maxClockSpeed();
    }

    /**
     * The NumberOfCores property contains a Processor's total number of
     * cores. e.g dual core machine will have NumberOfCores = 2.
     *
     * @return int
     */
    public function getNumberOfCores()
    {
        return $this->variant->numberOfCores();
    }

    /**
     * The NumberOfLogicalProcessors property specifies the total
     * number of logical processors.
     *
     * @return int
     */
    public function getNumberOfLogicalProcessors()
    {
        return $this->variant->numberOfLogicalProcessors();
    }

    /**
     * The ProcessorId property contains processor-specific information that describes
     * the processor's features. For x86 class CPUs, the field's format depends on the
     * processor's support of the CPUID instruction. If the instruction is supported,
     * the ProcessorId property contains two DWORD-formatted values. The first
     * (offsets 08h-0Bh) is the EAX value returned by a CPUID instruction with
     * input EAX set to 1. The second (offsets 0Ch-0Fh) is the EDX value returned
     * by that instruction. Only the first two bytes of the ProcessorID property
     * are significant (all others are set to 0) and contain (in WORD-format)
     * the contents of the DX register at CPU reset.
     *
     * @return string
     */
    public function getProcessorId()
    {
        return $this->variant->processorId();
    }

    /**
     * The ProcessorType property specifies the processor's primary function.
     *
     * @return mixed
     */
    public function getProcessorType()
    {
        $int = $this->variant->processorType();

        $possible = [
            1 => 'Other',
            2 => 'Unknown',
            3 => 'Central Processor',
            4 => 'Math Processor',
            5 => 'DSP Processor',
            6 => 'Video Processor',
        ];

        return $this->getFromPossibleValues($int, $possible);
    }

    /**
     * The Version property specifies an architecture-dependent processor revision
     * number. Note: This member is not used in Windows 95.
     *
     * Example: Model 2, Stepping 12.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->variant->version();
    }
}
