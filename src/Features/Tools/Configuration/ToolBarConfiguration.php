<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Configuration;

trait ToolBarConfiguration
{
    
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setToolBarStatus(bool $status): self
    {
        $this->toolBarStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setToolBarEnabled(): self
    {
        return $this->setToolBarStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setToolBarDisabled(): self
    {
        return $this->setToolBarStatus(false);
    }
}
