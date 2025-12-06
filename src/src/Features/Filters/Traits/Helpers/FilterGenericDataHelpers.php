<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Helpers;

use Livewire\Attributes\Computed;

trait FilterGenericDataHelpers
{
    /**
     * Determines if filterGenericData is set
     */
    public function hasFilterGenericData(): bool
    {
        return ! empty($this->filterGenericData);
    }

    /**
     * Retrieves Filter Generic Data
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getFilterGenericData(): array
    {
        if (! $this->hasFilterGenericData()) {
            $filterGenericData = $this->generateFilterGenericData();
            $this->setFilterGenericData($filterGenericData);

            return $filterGenericData;
        }

        return $this->filterGenericData;
    }
}
