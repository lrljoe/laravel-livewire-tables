<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HandlesDates, HasConfig, HasWireables, IsStringFilter};

class DateFilter extends Filter
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
    protected string $view = 'livewire-tables::components.tools.filters.date';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string|boolean
     */
    public function validate(string $value): string|bool
    {
        $this->setInputDateFormat('Y-m-d')->setOutputDateFormat($this->getConfig('pillFormat') ?? 'Y-m-d');
        $carbonDate = $this->createCarbonDate($value);
        if ($carbonDate instanceof \Carbon\Carbon) {
            return $carbonDate->format('Y-m-d');
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
            if ($carbonDate instanceof \Carbon\Carbon) {
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
                'type' => 'date',
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'date'),
            ]
        );
    }
}
