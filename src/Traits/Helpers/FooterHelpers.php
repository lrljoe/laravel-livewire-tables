<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait FooterHelpers
{
    #[Computed]
    public function shouldShowFooter(): bool
    {
        if($this->footerIsDisabled())
        {
            return false;
        }
        return $this->columns
            ->reject(fn (Column $column) => $column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)) || !$column->hasFooter())
            ->reject(fn (Column $column) => $this->currentlyReorderingIsEnabled() && !$column->isVisibleOnReorder())
            ->count() > 0;
    }

    public function hasColumnsWithFooter(): bool
    {
        return $this->columnsWithFooter === true;
    }

    public function getFooterStatus(): bool
    {
        return $this->footerStatus;
    }

    public function footerIsEnabled(): bool
    {
        return $this->getFooterStatus() === true;
    }

    public function footerIsDisabled(): bool
    {
        return $this->getFooterStatus() === false;
    }

    public function getUseHeaderAsFooterStatus(): bool
    {
        return $this->useHeaderAsFooterStatus;
    }

    #[Computed]
    public function useHeaderAsFooterIsEnabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === true;
    }

    public function useHeaderAsFooterIsDisabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === false;
    }

    public function shouldShowColumnTitlesInFooter(): bool
    {
        return $this->showColumnTitlesInFooter;
    }
}
