<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HandlesDates, HasConfig, HasWireables, IsStringFilter};

class DateTimeFilter extends Filter
{
    use HandlesDates,
        HasConfig,
        IsStringFilter;
    use HasWireables;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'live';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.datetime';

    /**
     * Undocumented variable
     */
    protected string $configPath = 'livewire-tables.dateTimeFilter.defaultConfig';

    /**
     * Validates that the value received by the Filter is valid
     */
    public function validate(string $value): string|bool
    {
        $this->setInputDateFormat('Y-m-d\TH:i')->setOutputDateFormat($this->getConfig('pillFormat'));

        $carbonDate = $this->createCarbonDate($value);
        if ($carbonDate instanceof \Carbon\Carbon) {
            return $carbonDate->format('Y-m-d\TH:i');
        }

        return false;
    }

    /**
     * Retrieves the Filter Value for use in the Filter Pills area
     *
     * @param  mixed  $value
     */
    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            return $this->getFilterPillValueAsFormattedDate($value);
        }

        return null;
    }

    /**
     * Undocumented function
     *
     * @return array<string,mixed>
     */
    protected function getCoreInputAttributes(): array
    {
        return $this->mergeCoreInputAttributes(
            [
                'min' => $this->hasConfig('min') ? $this->getConfig('min') : null,
                'max' => $this->hasConfig('max') ? $this->getConfig('max') : null,
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'type' => 'datetime-local',
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'datetime'),
            ]
        );
    }

    protected function initialiseConfig(): void
    {
        $this->config(config($this->configPath));
    }
}
