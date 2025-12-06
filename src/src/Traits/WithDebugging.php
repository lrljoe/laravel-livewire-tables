<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithDebugging
{
    /**
     * Dump table properties for debugging
     *
     * @var boolean
     */
    protected bool $debugStatus = false;

    /**
     * Get Debug Status
     *
     * @return boolean
     */
    public function getDebugStatus(): bool
    {
        return $this->debugStatus;
    }

    /**
     * Check if Debug Is Enabled
     *
     * @return boolean
     */
    public function debugIsEnabled(): bool
    {
        return $this->getDebugStatus() === true;
    }

    /**
     * Check if Debug Is Disabled
     *
     * @return boolean
     */
    public function debugIsDisabled(): bool
    {
        return $this->getDebugStatus() === false;
    }

    /**
     * Set Debug Mode Status for the Table
     *
     * @param boolean $debugStatus
     * @return self
     */
    public function setDebugStatus(bool $debugStatus): self
    {
        $this->debugStatus = $debugStatus;

        return $this;
    }

    /**
     * Enable Debug Mode for the Table
     *
     * @return self
     */
    public function setDebugEnabled(): self
    {
        return $this->setDebugStatus(debugStatus: true);
    }

    /**
     * Disable Debug Mode for the Table
     *
     * @return self
     */
    public function setDebugDisabled(): self
    {
        return $this->setDebugStatus(debugStatus: false);
    }
}
