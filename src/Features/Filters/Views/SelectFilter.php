<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasOptions, HasWireables, IsStringFilter};

class SelectFilter extends Filter
{
    use HasOptions,
        IsStringFilter;
    use HasWireables;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'live';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.select';

    /**
     * Undocumented variable
     */
    protected string $configPath = 'livewire-tables.selectFilter.defaultConfig';

    protected ?string $optionsPath = 'livewire-tables.selectFilter.defaultOptions';

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return (new Collection($this->getOptions()))
            ->map(fn ($value, $key) => is_iterable($value) ? (new Collection($value))->keys() : $key)
            ->flatten()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value) > 0)
            ->values()
            ->toArray();
    }

    /**
     * Validates that the value received by the Filter is valid
     *
     * @return array<mixed>|string|bool
     */
    public function validate(string $value): array|string|bool
    {
        if (! in_array($value, $this->getKeys())) {
            return false;
        }

        return $value;
    }

    /**
     * Retrieves the Filter Value for use in the Filter Pills area
     *
     * @param  mixed  $value
     * @return array<mixed>|string|bool|null
     */
    public function getFilterPillValue($value): array|string|bool|null
    {

        return $this->getCustomFilterPillValue($value)
            ?? (new Collection($this->getOptions()))
                ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$value]
            ?? null;
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
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'select'),
            ]
        );
    }
}
