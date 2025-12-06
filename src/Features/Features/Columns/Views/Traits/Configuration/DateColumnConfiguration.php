<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration;

trait DateColumnConfiguration
{
    /**
     * Define the Empty Value to use for the Column
     */
    public function emptyValue(string $emptyValue): self
    {
        $this->emptyValue = $emptyValue;

        return $this;
    }
}
