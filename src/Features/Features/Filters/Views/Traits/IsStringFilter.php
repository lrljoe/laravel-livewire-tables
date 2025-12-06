<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait IsStringFilter
{
    /**
     * Determines if the String Filter is Empty
     */
    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for the String Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
