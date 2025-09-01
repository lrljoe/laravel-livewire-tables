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
    public array $externalFilterPillsOptions = [];

    /**
     * Undocumented variable
     *
     * @var array<string,array<int,string>>
     */
    public array $externalFilterPills = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $internalFilterPillsVals = ['name' => null];

   //.. public array $externalFilterPillsLength = [];

   // public array $internalFilterPillsLength = [];
}
