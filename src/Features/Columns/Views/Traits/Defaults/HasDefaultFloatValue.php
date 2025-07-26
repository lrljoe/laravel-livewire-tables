<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults;

trait HasDefaultFloatValue
{
    public float $defaultValue = 0;

    public function defaultValue(int|float|string $defaultValue): self
    {
        $this->defaultValue = floatval($defaultValue);

        return $this;
    }

    public function getDefaultValue(): float
    {
        return $this->defaultValue;
    }
}
