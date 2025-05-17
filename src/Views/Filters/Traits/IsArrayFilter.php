<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait IsArrayFilter
{
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
     * Undocumented function
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
     * Undocumented function
     *
     * @return string
     */
    public function getPillsSeparator(): string
    {
        return $this->pillsSeparator ?? ', ';
    }

    /**
     * Undocumented function
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
