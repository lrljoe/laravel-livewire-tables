<?php

namespace Rappasoft\LaravelLivewireTables\Features\SecondaryHeader;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Features\SecondaryHeader\Styling\HasSecondaryHeaderStyling;

trait WithSecondaryHeader
{
    use HasSecondaryHeaderStyling;

    /**
     * Undocumented variable
     */
    protected bool $secondaryHeaderStatus = true;

    /**
     * Undocumented variable
     */
    protected bool $columnsWithSecondaryHeader = false;

    /**
     * Undocumented function
     */
    public function shouldShowSecondaryHeader(): bool
    {
        if ($this->secondaryHeaderIsDisabled()) {
            return false;
        }

        return $this->columns
            ->reject(fn (Column $column) => $column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)) || ! $column->hasSecondaryHeader())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && ! $column->isVisibleOnReorder())
            ->count() > 0;
    }

    /**
     * Undocumented function
     */
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader;
    }

    /**
     * Undocumented function
     */
    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    /**
     * Undocumented function
     */
    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    /**
     * Undocumented function
     */
    public function setSecondaryHeaderStatus(bool $status): self
    {
        $this->secondaryHeaderStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSecondaryHeaderEnabled(): self
    {
        return $this->setSecondaryHeaderStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setSecondaryHeaderDisabled(): self
    {
        return $this->setSecondaryHeaderStatus(false);
    }
}
