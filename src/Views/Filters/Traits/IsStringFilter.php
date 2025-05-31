<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait IsStringFilter
{
    /**
     * Determines if the String Filter is Empty
     *
     * @param string|null $value
     * @return boolean
     */
    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

     /**
      * Gets the Default Value for the String Filter via the Component
      *
      * @return string|null
      */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
