<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait HandlesDefaultValue
{
    /**
     * The property containing the Default Value for a Filter
     */
    protected mixed $filterDefaultValue = null;

    /**
     * Sets a Default Value via the Filter Component
     *
     * @param  mixed  $value
     */
    public function setFilterDefaultValue($value): self
    {
        $this->filterDefaultValue = $value;

        return $this;
    }

    /**
     * Get the Default Value for the Filter
     */
    public function getDefaultValue(): mixed
    {
        return null;
    }

    /**
     * Determines if the Filter has a Default Value via the Component
     */
    public function hasFilterDefaultValue(): bool
    {
        return ! is_null($this->filterDefaultValue);
    }
}
