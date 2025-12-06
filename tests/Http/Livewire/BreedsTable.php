<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\NumberFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\SelectFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\TextFilter;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class BreedsTable extends BaseTable
{
    public $model = Breed::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),

            Column::make('Name')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }
}
