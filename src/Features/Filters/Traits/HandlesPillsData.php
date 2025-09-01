<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;

trait HandlesPillsData
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getPillDataForFilter(): array
    {
        $filters = [];

        foreach ($this->getAppliedFiltersWithValuesForPills() as $filterKey => $value) {
            if (! is_null($filter = $this->getFilterByKey($filterKey)))
            {
                if(!method_exists($filter, 'isAnExternalLivewireFilter') || !$filter->isAnExternalLivewireFilter())
                {
                    $value = $filter->validate($value);
                }

                if (!$filter->isEmpty($value))
                {
                    if((method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter()))
                    {
                        $filterPillsValues = $this->externalFilterPillsValues[$filterKey] ?? [];

                        if(!empty($filterPillsValues))
                        {
                            $filter->options($filterPillsValues);
                        }
                    }
                    else
                    {
                        $filterPillsValues = $filter->getFilterPillValue($value);
                    }

                    if(!empty($filterPillsValues))
                    {
                        $sep = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ';
                        if(is_array($filterPillsValues))
                        {
                        $filterPillsValues = implode($sep, $filterPillsValues);
                        }

                    }
                    $filters[$filter->getKey()] = FilterPillData::make(
                        filterKey: $filter->getKey(),
                        customPillBlade: $filter->getCustomPillBlade() ?? null,
                        filterPillsItemAttributes: array_merge($this->getFilterPillsItemAttributes(), ($filter->hasPillAttributes() ? $filter->getPillAttributes() : [])),

                        filterPillTitle: $filter->getFilterPillTitle(),
                        filterPillValue: $filterPillsValues,

                        hasCustomPillBlade: $filter->hasCustomPillBlade(),
                        isAnExternalLivewireFilter: (method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter()),
                        separator: method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ',
                        renderPillsAsHtml: $filter->getPillsAreHtml() ?? false,
                        renderPillsTitleAsHtml: $filter->getFilterPillTitleAsHtml() ?? false,
                        customResetButtonAttributes: $filter->getPillResetButtonAttributes(),

                    );

                }

            }
        }

        return $filters;
    }
}
