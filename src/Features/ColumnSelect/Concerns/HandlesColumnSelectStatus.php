<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesColumnSelectStatus
{
    /**
     * Determines if Column Select should be in use
     */
    protected bool $columnSelectStatus = true;

    protected function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    protected function setColumnSelectEnabled(): self
    {
        return $this->setColumnSelectStatus(true);
    }

    protected function setColumnSelectDisabled(): self
    {
        return $this->setColumnSelectStatus(false);
    }

    /**
     * Undocumented function
     */
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus ?? true;
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }
}
