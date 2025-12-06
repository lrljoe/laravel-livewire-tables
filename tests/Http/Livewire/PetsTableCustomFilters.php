<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
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

class PetsTableCustomFilters extends PetsTable
{
    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Breed')
                ->options(
                    Breed::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($breed) => $breed->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('breed_id', $values);
                }),
            MultiSelectDropdownFilter::make('Species')
                ->options(
                    Species::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($species) => $species->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $values) {
                    return $builder->whereIn('species_id', $values);
                })
                ->setPillsSeparator('<br />'),

        ];
    }
}
