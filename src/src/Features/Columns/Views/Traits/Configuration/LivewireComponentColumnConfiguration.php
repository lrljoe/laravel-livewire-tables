<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration;

use Illuminate\Support\Str;

trait LivewireComponentColumnConfiguration
{
    /**
     * Defines which component to use
     */
    public function component(string $livewireComponent): self
    {
        $this->livewireComponent = (Str::startsWith($livewireComponent, 'livewire:')) ? substr($livewireComponent, 9) : $livewireComponent;

        return $this;
    }
}
