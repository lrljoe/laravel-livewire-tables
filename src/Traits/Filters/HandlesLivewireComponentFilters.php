<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\On;

trait HandlesLivewireComponentFilters
{
    protected bool $hasExternalFilters = false;

    public function tableHasExternalFilters(): bool
    {
        return $this->hasExternalFilters;
    }

}
