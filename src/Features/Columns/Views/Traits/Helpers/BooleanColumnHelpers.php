<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers;

trait BooleanColumnHelpers
{

    
    public function checkSuccess(bool $val): bool
    {
        return $this->getSuccessValue() == $val;
    }

    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIsToggleable(): bool
    {
        return $this->isToggleable ?? false;
    }

    public function getToggleMethod(): ?string
    {
        return $this->toggleMethod ?? null;
    }
}
