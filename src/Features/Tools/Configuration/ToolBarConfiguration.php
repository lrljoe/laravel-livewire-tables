<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolBarConfiguration
{
    
    public function setToolBarStatus(bool $status): self
    {
        $this->toolBarStatus = $status;

        return $this;
    }

    public function setToolBarEnabled(): self
    {
        return $this->setToolBarStatus(true);
    }

    public function setToolBarDisabled(): self
    {
        return $this->setToolBarStatus(false);
    }
}
