<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasOptions, HasWireables, IsArrayFilter};

class MultiSelectFilter extends Filter
{
    use HasOptions,
        IsArrayFilter;
    use HasWireables;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $wireMethod = 'live.debounce.250ms';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::components.tools.filters.multi-select';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $configPath = 'livewire-tables.multiSelectFilter.defaultConfig';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $optionsPath = 'livewire-tables.multiSelectFilter.defaultOptions';

    /**
     * Undocumented function
     *
     * @param integer|string|array<mixed> $value
     * @return array<mixed>|integer|string|boolean
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
     * Undocumented function
     *
     * @param mixed $value
     * @return array<mixed>|string|boolean|null
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
