<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolsConfiguration
{
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setToolsStatus(bool $status): self
    {
        $this->toolsStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setToolsEnabled(): self
    {
        return $this->setToolsStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setToolsDisabled(): self
    {
        return $this->setToolsStatus(false);
    }
}
