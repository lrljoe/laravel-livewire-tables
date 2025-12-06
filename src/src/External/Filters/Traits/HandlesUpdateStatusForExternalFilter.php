<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

use Livewire\Attributes\{On,Renderless};

trait HandlesUpdateStatusForExternalFilter
{
    /**
     * Undocumented variable
     */
    public bool $skipUpdate = false;

    /**
     * Undocumented variable
     */
    protected bool $needsUpdating = false;
}
