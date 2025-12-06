<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolsConfiguration
{
    /**
     * Undocumented function
     */
    public function setToolsStatus(bool $status): self
    {
        $this->toolsStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setToolsEnabled(): self
    {
        return $this->setToolsStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setToolsDisabled(): self
    {
        return $this->setToolsStatus(false);
    }
}
