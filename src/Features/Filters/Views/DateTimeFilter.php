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
     *
     * @var string
     */
    public string $wireMethod = 'live';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::components.tools.filters.datetime';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $configPath = 'livewire-tables.dateTimeFilter.defaultConfig';

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string|boolean
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
     * Undocumented function
     *
     * @param mixed $value
     * @return string|null
     */
    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            $carbonDate = $this->createCarbonDate($value);
            if ($carbonDate && $carbonDate instanceof \Carbon\Carbon) {
                return $this->outputTranslatedDate($carbonDate);
            }
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
