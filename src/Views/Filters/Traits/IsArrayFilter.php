<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait IsArrayFilter
{
    /**
     * The separator used for the Filter Pills values for this filter
     *
     * @var string
     */
    public string $pillsSeparator = ', ';

    /**
     * Get the filter default options.
     *
     * @return array<mixed> 
     */
     public function getDefaultValue(): array
    {
        return [];
    }

    /**
     * Gets the Default Value for this Filter via the Component
     *
     * @return array<mixed> 
     */
     public function getFilterDefaultValue(): array
    {
        return $this->filterDefaultValue ?? [];
    }

    /**
     * Determines if this Filter is empty
     *
     * @param mixed $value
     * @return boolean
     */
    public function isEmpty(mixed $value): bool
    {
        if (! is_array($value)) {
            return true;
        }

        return empty($value);
    }

    /**
     * Retrieves the separator string for the Filter Pills for this filter
     *
     * @return string
     */
    public function getPillsSeparator(): string
    {
        return $this->pillsSeparator ?? ', ';
    }

    /**
     * Sets the separator string for the Filter Pills for this filter
     *
     * @param string $pillsSeparator
     * @return self
     */
    public function setPillsSeparator(string $pillsSeparator): self
    {
        $this->pillsSeparator = $pillsSeparator;

        return $this;
    }
}
