<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults;

trait HasDefaultIntegerValue
{
    public int $defaultValue = 0;

    public function defaultValue(int|string $defaultValue): self
    {
        $this->defaultValue = intval($defaultValue);

        return $this;
    }

    public function getDefaultValue(): int
    {
        return $this->defaultValue;
    }
}
