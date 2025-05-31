<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterPillsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterPillsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\HasFilterPillsStyling;

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

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $externalFilterPillsLength = [];

 /**
  * Undocumented variable
  *
  * @var array<mixed>
  */
    public array $internalFilterPillsLength = [];
}
