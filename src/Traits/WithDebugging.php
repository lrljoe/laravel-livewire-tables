<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithDebugging
{
    /**
     * Dump table properties for debugging
     */
    protected bool $debugStatus = false;

    /**
     * Get Debug Status
     */
    public function getDebugStatus(): bool
    {
        return $this->debugStatus;
    }

    /**
     * Check if Debug Is Enabled
     */
    public function debugIsEnabled(): bool
    {
        return $this->getDebugStatus() === true;
    }

    /**
     * Check if Debug Is Disabled
     */
    public function debugIsDisabled(): bool
    {
        return $this->getDebugStatus() === false;
    }

    /**
     * Set Debug Mode Status for the Table
     */
    public function setDebugStatus(bool $debugStatus): self
    {
        $this->debugStatus = $debugStatus;

        return $this;
    }

    /**
     * Enable Debug Mode for the Table
     */
    public function setDebugEnabled(): self
    {
        return $this->setDebugStatus(debugStatus: true);
    }

    /**
     * Disable Debug Mode for the Table
     */
    public function setDebugDisabled(): self
    {
        return $this->setDebugStatus(debugStatus: false);
    }
}
