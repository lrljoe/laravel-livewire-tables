<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

trait DateColumnHelpers
{
    /**
     * Retrieve the Empty Value to use for the Column
     */
    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }

    public function getValue(Model $row): Carbon|DateTime|CarbonImmutable|DateTimeImmutable|string|null
    {
        if ($this->isBaseColumn()) {
            return $row->{$this->getField()};
        }

        return $row->{$this->getRelationString().'.'.$this->getField()};
    }
}
