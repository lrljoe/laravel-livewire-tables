<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\NumberFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\SelectFilter;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\TextFilter;

class PetsTableMount extends PetsTable
{
    public ?int $mountBreed = null;

    public function mount(?int $mountBreed = null)
    {
        if (isset($mountBreed)) {
            $this->mountBreed = $mountBreed;
        }
    }

    public function builder(): Builder
    {
        if (isset($this->mountBreed)) {
            return Pet::where('breed_id', $this->mountBreed);
        }

        return Pet::query();
    }
}
