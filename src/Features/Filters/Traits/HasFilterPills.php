<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration\FilterPillsConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers\FilterPillsHelpers;
use Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Styling\HasFilterPillsStyling;

trait HasFilterPills
{
    use FilterPillsConfiguration,
        FilterPillsHelpers,
        HasFilterPillsStyling;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $externalFilterPillsValues = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $internalFilterPillsVals = ['name' => null];

   //.. public array $externalFilterPillsLength = [];

   // public array $internalFilterPillsLength = [];
}
