<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolBarConfiguration
{
    /**
     * Undocumented function
     */
    public function setToolBarStatus(bool $status): self
    {
        $this->toolBarStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setToolBarEnabled(): self
    {
        return $this->setToolBarStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setToolBarDisabled(): self
    {
        return $this->setToolBarStatus(false);
    }
}
