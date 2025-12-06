<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Livewire\Attributes\Locked;

trait WithFeatureDetection
{

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $loadedOptionalFeatures = [];

    /**
     * Undocumented function
     *
     * @param mixed $class
     * @param boolean $autoload
     * @return array<mixed>
     */
    protected static function class_uses_deep($class, $autoload = true): array
    {
        $traits = [];

        // Get traits of all parent classes
        do {
            $traits = array_merge(class_uses($class, $autoload), $traits);
        } while ($class = get_parent_class($class));

        // Get traits of all parent traits
        $traitsToSearch = $traits;
        while (!empty($traitsToSearch)) {
            $newTraits = class_uses(array_pop($traitsToSearch), $autoload);
            $traits = array_merge($newTraits, $traits);
            $traitsToSearch = array_merge($newTraits, $traitsToSearch);
        };

        foreach ($traits as $trait => $same) {
            $traits = array_merge(class_uses($trait, $autoload), $traits);
        }

        return array_unique($traits);
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function mountWithFeatureDetection(): void
    {
        /*$selfClasses = $this::class_uses_deep($this);

        /*$optionalFeatures = [
            'Rappasoft\LaravelLivewireTables\Traits\ComponentUtilities' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithCustomisations' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithData' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithDebugging' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithEvents' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithLoadingPlaceholder' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithQuery' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithQueryString' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithRefresh' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithSessionStorage' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithTableHooks' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithTableAttributes' => false,
            'Rappasoft\LaravelLivewireTables\Traits\WithTools' => false,
            'Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations' => false,
            'Rappasoft\LaravelLivewireTables\Traits\Styling\HasCoreStyling' => false,
            'Rappasoft\LaravelLivewireTables\Features\Actions\Core\WithActions' => false,
            'Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\WithBulkActions' => false,
            'Rappasoft\LaravelLivewireTables\Features\Columns\Core\WithColumns' => false,
            'Rappasoft\LaravelLivewireTables\Features\Columns\Core\WithColumnsCollapsing' => false,
            'Rappasoft\LaravelLivewireTables\Features\Columns\Core\WithColumnSelect' => false,
            'Rappasoft\LaravelLivewireTables\Features\ConfigurableAreas\WithConfigurableAreas' => false,
            'Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters' => false,
            'Rappasoft\LaravelLivewireTables\Features\Footer\WithFooter' => false,
            'Rappasoft\LaravelLivewireTables\Features\Pagination\WithPagination' => false,
            'Rappasoft\LaravelLivewireTables\Features\Reordering\WithReordering' => false,
            'Rappasoft\LaravelLivewireTables\Features\Search\WithSearch' => false,
            'Rappasoft\LaravelLivewireTables\Features\SecondaryHeader\WithSecondaryHeader' => false,
            'Rappasoft\LaravelLivewireTables\Features\Sorting\WithSorting' => false,
            'Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasTheme' => false,

        ];*/
       /* $loadedFeatures = [
            'Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters' => false,
            'Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\WithColumnsCollapsing' => false,
            'Rappasoft\LaravelLivewireTables\Features\ColumnSelect\WithColumnSelect' => false,
            'Rappasoft\LaravelLivewireTables\Features\Search\WithSearch' => false,
            'Rappasoft\LaravelLivewireTables\Features\Reordering\WithReordering' => false,
            'Rappasoft\LaravelLivewireTables\Features\Sorting\WithSorting' => false,
            'App\Domains\AdvancedTables\WithSavingTableState' => false,

        ];
        $loadedTraits = class_uses_recursive($this);
        foreach($loadedFeatures as $featureName => $status)
        {
            $loadedFeatures[$featureName] = in_array($featureName,$loadedTraits);
        }
        dd($loadedFeatures);*/

        /*
        $loadedFeatures = [
            'Rappasoft\LaravelLivewireTables\Features\Filters\Traits\WithFilters' => false,
            'Rappasoft\LaravelLivewireTables\Features\ColumnsCollapsing\WithColumnsCollapsing' => false,
            'Rappasoft\LaravelLivewireTables\Features\Columns\Core\WithColumnSelect' => false,
            'Rappasoft\LaravelLivewireTables\Features\Search\WithSearch' => false,
            'Rappasoft\LaravelLivewireTables\Features\Reordering\WithReordering' => false,
            'Rappasoft\LaravelLivewireTables\Features\Sorting\WithSorting' => false,
        ];

        foreach($selfClasses as $selfClass)
        {
            if(Str::startsWith($selfClass, 'Rappasoft\LaravelLivewireTables'))
            {
                if(array_key_exists($selfClass, $loadedFeatures))
                {
                    $featureSplit = explode('\\',$selfClass);
                    $feature = end($featureSplit);
                    $loadedFeatures[$feature] = true;
                }
            }
        }
        $this->loadedOptionalFeatures = $loadedFeatures;       */
    }

    /**
     * Undocumented function
     *
     * @param string $feature
     * @return boolean
     */
    protected function optionalFeatureIsLoaded(string $feature): bool
    {
        return in_array($feature, $this->loadedOptionalFeatures) ? $this->loadedOptionalFeatures[$feature] : false;
    }

}