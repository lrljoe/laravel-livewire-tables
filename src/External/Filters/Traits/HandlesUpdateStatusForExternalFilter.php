<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

use Livewire\Attributes\{On,Renderless};

trait HandlesUpdateStatusForExternalFilter
{
    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public bool $skipUpdate = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $needsUpdating = false;
}
