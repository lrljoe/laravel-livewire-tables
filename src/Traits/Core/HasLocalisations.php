<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core;

use Livewire\Attributes\Computed;

trait HasLocalisations
{
    /**
     * Undocumented variable
     */
    public string $localisationPathString = 'livewire-tables::core.';

    /**
     * Undocumented function
     */
    #[Computed]
    public function getLocalisationPath(): string
    {
        return $this->generateLocalisationPath();
    }

    /**
     * Undocumented function
     */
    public function generateLocalisationPath(): string
    {
        $this->localisationPathString = (config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.';

        return $this->localisationPathString;
    }
}
