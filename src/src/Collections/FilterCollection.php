<?php

namespace Rappasoft\LaravelLivewireTables\Collections;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;

/**
 * Collection of Filters
 * 
 * @extends \Illuminate\Support\Collection<int|string,Filter> 
 */
class FilterCollection extends Collection
{

    public function forPills()
    {
        $temp = collect($this->each(function (Filter $filter)  {
            $extraItems = [];

            $filter->exportData = [
                'key' => $filter->getKey(), 
                'title' => $filter->getFilterPillTitle(),
                'titleAsHTML' => $filter->getFilterPillTitleAsHtml(),
                'locale' => $filter->getPillsLocale(),
                'contentAsHTML' => $filter->getPillsAreHtml(),
                'attributes' => $filter->getPillAttributes(),
                'resetButtonAttributes' => $filter->getPillResetButtonAttributes(),
                'values' => null,
            ];
            if(method_exists($filter, 'getOptions'))
            {
                $extraItems['options'] = $filter->getOptions();
            }
            if($filter->hasCustomPillBlade())
            {
                $extraItems['hasCustomBlade'] = true;
                $extraItems['customBlade'] = $filter->getCustomPillBlade();
            }
            if(method_exists($filter, 'isAnExternalLivewireFilter') && $filter->isAnExternalLivewireFilter())
            {
                $extraItems['separator'] = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ',';
            }
            $filter->exportData = array_merge($filter->exportData, $extraItems);

            return $filter;
        })->pluck('exportData'));

        return $temp;
    }
}