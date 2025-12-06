<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HandlesColumnSelectVisibility
{
    /**
     * Sets whether Column Select is Hidden on Mobile
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnMobile = false;

    /**
     * Sets whether Column Select is Hidden on Tablet
     *
     * @var boolean
     */
    protected bool $columnSelectHiddenOnTablet = false;


    /**
     * Set Column Select Is Hidden On Mobile Enabled
     *
     * @return self
     */
    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    /**
     * Set Column Select Is Hidden On Tablet Enabled
     *
     * @return self
     */
    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    /**
     * Retrieve whether Column Select Is Hidden On Tablet
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    /**
     * Retrieve whether Column Select Is Hidden On Mobile
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }
}
