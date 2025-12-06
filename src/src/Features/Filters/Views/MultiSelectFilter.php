<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasOptions, HasWireables, IsArrayFilter};

class MultiSelectFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;
    use HasWireables;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'live.debounce.250ms';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.multi-select';

    /**
     * Undocumented variable
     */
    protected string $configPath = 'livewire-tables.multiSelectFilter.defaultConfig';

    protected ?string $optionsPath = 'livewire-tables.multiSelectFilter.defaultOptions';

    /**
     * Validates that the value received by the Filter is valid
     *
     * @param  int|string|array<mixed>  $value
     * @return array<mixed>|int|string|bool
     */
    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }
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
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item) ?? $this->getOptions()[$item] ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }
}
