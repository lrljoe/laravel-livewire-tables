<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Styling\HasSecondaryHeaderStyling;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait WithSecondaryHeader
{
    use HasSecondaryHeaderStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $secondaryHeaderStatus = true;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $columnsWithSecondaryHeader = false;

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function shouldShowSecondaryHeader(): bool
    {
        if($this->secondaryHeaderIsDisabled())
        {
            return false;
        }
        return $this->columns
            ->reject(fn (Column $column) => $column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)) || !$column->hasSecondaryHeader())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->count() > 0;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setSecondaryHeaderStatus(bool $status): self
    {
        $this->secondaryHeaderStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSecondaryHeaderEnabled(): self
    {
        return $this->setSecondaryHeaderStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setSecondaryHeaderDisabled(): self
    {
        return $this->setSecondaryHeaderStatus(false);
    }
}
