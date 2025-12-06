<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

trait HandlesColumnSelectRemembering
{
    protected function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->storeColumnSelectInSessionStatus($status);

        return $this;
    }

    protected function setRememberColumnSelectionEnabled(): self
    {
        return $this->setRememberColumnSelectionStatus(true);
    }

    protected function setRememberColumnSelectionDisabled(): self
    {
        return $this->setRememberColumnSelectionStatus(false);
    }
}
