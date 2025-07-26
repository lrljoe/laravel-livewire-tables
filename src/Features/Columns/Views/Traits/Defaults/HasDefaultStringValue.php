<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults;

trait HasDefaultStringValue
{
    public string $defaultValue = '';

    public function defaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }
}
