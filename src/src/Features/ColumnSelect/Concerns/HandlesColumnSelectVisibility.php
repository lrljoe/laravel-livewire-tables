<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesColumnSelectVisibility
{
    /**
     * Sets whether Column Select is Hidden on Mobile
     */
    protected bool $columnSelectHiddenOnMobile = false;

    /**
     * Sets whether Column Select is Hidden on Tablet
     */
    protected bool $columnSelectHiddenOnTablet = false;

    /**
     * Set Column Select Is Hidden On Mobile Enabled
     */
    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    /**
     * Set Column Select Is Hidden On Tablet Enabled
     */
    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    /**
     * Retrieve whether Column Select Is Hidden On Tablet
     */
    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    /**
     * Retrieve whether Column Select Is Hidden On Mobile
     */
    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }
}
