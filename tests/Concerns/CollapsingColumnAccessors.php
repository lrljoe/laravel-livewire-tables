<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Concerns;

trait CollapsingColumnAccessors
{
    public function pubSetCollapsingColumnsStatus(bool $status): self
    {
        return $this->setCollapsingColumnsStatus($status);
    }

    public function pubSetCollapsingColumnsEnabled(): self
    {
        return $this->setCollapsingColumnsEnabled();
    }

    public function pubSetCollapsingColumnsDisabled(): self
    {
        return $this->setCollapsingColumnsEnabled();
    }
}
