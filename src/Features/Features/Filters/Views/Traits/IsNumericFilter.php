<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait IsNumericFilter
{
    /**
     * Determines if the Numeric Filter is empty
     *
     * @param  float|int|string|array<mixed>|null  $value
     */
    public function isEmpty(float|int|string|array|null $value): bool
    {
        return ! is_null($value) ? ($this->validate($value) == false) : true;
    }

    /**
     * Gets the Default Value for the Numeric Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
