<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pills\FilterPills;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Collections\FilterCollection;
use Livewire\Attributes\On;

class PillsWidget extends Component
{
    public string $dataTableFingerprint = '';
    public mixed $filters;
    public array $externalFilterPillsValues = [];
    public array $externalFilterPillsOptions = [];



    #[On('livewireExternalArrayFilterConfig')]
    public function filterConfig(string $dataTableFingerprint, string $filterKey, array $filterConfig = []): void
    {
        $this->filters[$filterKey] = array_merge(['label' => '', 'options' => [], 'values' => [], 'config' => []], $this->filters[$filterKey] ?? []);
        $this->filters[$filterKey]['config'] = $filterConfig;

    }

   // #[On('livewireExternalArrayFilterValuesUpdateNew')]
    public function filterValuesSet(string $dataTableFingerprint, string $filterKey,  array $filterOptions = [], array $selectedValues = []): void
    {
        if(isset($this->externalFilterPillsOptions[$filterKey]))
        {
            $this->externalFilterPillsOptions[$filterKey] = array_merge($this->externalFilterPillsOptions[$filterKey], $filterOptions);
        }
        else
        {
            $this->externalFilterPillsOptions[$filterKey] = $filterOptions;
        }

        $displayArray = [];
        $relevantOptions = $this->externalFilterPillsOptions[$filterKey];

        foreach($selectedValues as $selectedValue)
        {
            if(array_key_exists($selectedValue, $relevantOptions))
            {
                $displayArray[] =  $relevantOptions[$selectedValue];
            }
            
        }
        $this->externalFilterPillsValues[$filterKey] = $displayArray;
    }

   // #[On('livewireExternalArrayFilterOptionsUpdateNew')]
    public function mergeExtraPillsOptions(string $filterKey, array $filterOptions): void
    {
        if(isset($this->externalFilterPillsOptions[$filterKey]))
        {
            $this->externalFilterPillsOptions[$filterKey] = array_merge($this->externalFilterPillsOptions[$filterKey], $filterOptions);
        }
        else
        {
            $this->externalFilterPillsOptions[$filterKey] = $filterOptions;
        }
    }


    public function render()
    {
        return view('livewire-tables::includes.pills-widget');
    }
}