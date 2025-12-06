<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait FilterConfiguration
{
    /**
     * Sets Generic Filter Data
     *
     * @param  array<mixed>  $genericDisplayData
     */
    public function setGenericDisplayData(array $genericDisplayData = []): self
    {
        $this->genericDisplayData = [
            'filterLayout' => $genericDisplayData['filterLayout'],
            'dataTableFingerprint' => $genericDisplayData['dataTableFingerprint'],
            'tableName' => $genericDisplayData['tableName'],
            'isTailwind' => $genericDisplayData['isTailwind'],
            'isTailwind4' => $genericDisplayData['isTailwind4'] ?? false,
            'isBootstrap' => ($genericDisplayData['isBootstrap4'] || $genericDisplayData['isBootstrap5']),
            'isBootstrap4' => $genericDisplayData['isBootstrap4'],
            'isBootstrap5' => $genericDisplayData['isBootstrap5'],
            'localisationPath' => $genericDisplayData['localisationPath'] ?? ((config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.'),

        ];

        return $this;
    }
}
