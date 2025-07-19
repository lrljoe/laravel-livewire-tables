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
     * Undocumented function
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }


    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

}
