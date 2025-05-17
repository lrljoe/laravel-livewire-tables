<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

trait ButtonGroupColumnHelpers
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getButtons(): array
    {
        return collect($this->buttons)
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }
}
