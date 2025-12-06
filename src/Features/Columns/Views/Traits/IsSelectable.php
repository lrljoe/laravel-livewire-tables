<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait IsSelectable
{
    protected bool $selectable = true;

    protected bool $selected = true;

    protected ?string $columnSelectTitle;

    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    public function isSelected(): bool
    {
        return $this->selected === true;
    }

    public function excludeFromColumnSelect(): self
    {
        $this->selectable = false;

        return $this;
    }

    public function deselected(): self
    {
        $this->selected = false;

        return $this;
    }

    public function selectedIf(callable|bool $value): self
    {
        if (is_bool($value)) {
            $this->selected = $value;
        } else {
            $this->selected = call_user_func($value);
        }

        return $this;
    }

    public function deselectedIf(callable|bool $value): self
    {
        if (is_bool($value)) {
            $this->selected = ! $value;
        } else {
            $this->selected = ! call_user_func($value);
        }

        return $this;
    }

    protected function hasColumnSelectTitle(): bool
    {
        return isset($this->columnSelectTitle);
    }

    public function setColumnSelectTitle(string $columnSelectTitle): self
    {
        $this->columnSelectTitle = $columnSelectTitle;

        return $this;
    }

    public function getColumnSelectTitle(): string
    {
        return $this->hasColumnSelectTitle() ? $this->columnSelectTitle : $this->getTitle();
    }
}
