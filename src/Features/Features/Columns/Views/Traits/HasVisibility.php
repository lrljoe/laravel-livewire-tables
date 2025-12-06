<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait HasVisibility
{
    protected bool $hidden = false;

    protected bool $visibleOnReorder = true;

    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    public function isHidden(): bool
    {
        return $this->hidden === true;
    }

    public function hideIf(mixed $condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    public function isVisibleOnReorder(): bool
    {
        return $this->visibleOnReorder;
    }

    public function hideOnReorder(): self
    {
        $this->visibleOnReorder = false;

        return $this;
    }
}
