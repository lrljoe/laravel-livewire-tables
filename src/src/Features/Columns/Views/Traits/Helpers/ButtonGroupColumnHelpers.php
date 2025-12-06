<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Features\Columns\Views\LinkColumn;

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
