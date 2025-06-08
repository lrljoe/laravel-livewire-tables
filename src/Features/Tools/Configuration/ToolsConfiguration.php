<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolsConfiguration
{
    public function setToolsStatus(bool $status): self
    {
        $this->toolsStatus = $status;

        return $this;
    }

    public function setToolsEnabled(): self
    {
        return $this->setToolsStatus(true);
    }

    public function setToolsDisabled(): self
    {
        return $this->setToolsStatus(false);
    }
}
