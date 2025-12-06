<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesColumnSelectStatus
{

    /**
     * Determines if Column Select should be in use
     *
     * @var boolean
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
     *
     * @return boolean
     */
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus ?? true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    #[Computed]
    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

}