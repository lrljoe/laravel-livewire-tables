<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Livewire\Attributes\On;

trait HandlesLivewireComponentFilters
{
    protected bool $hasExternalFilters = false;

    public function tableHasExternalFilters(): bool
    {
        return $this->hasExternalFilters;
    }
}
