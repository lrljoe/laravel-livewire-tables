<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasOptions, HasWireables, IsArrayFilter};

class MultiSelectDropdownFilter extends Filter
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
     * The path to the view for this filter
     *
     * @var string
     */
    protected string $view = 'livewire-tables::components.tools.filters.multi-select-dropdown';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $configPath = 'livewire-tables.multiSelectDropdownFilter.defaultConfig';

    protected ?string $optionsPath = 'livewire-tables.multiSelectDropdownFilter.defaultOptions';

    /**
     * Validates that the value received by the Filter is valid
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

            return $value;
        }

        return (is_int($value) || is_string($value)) ? $value : false;
    }

    /**
     * Retrieves the Filter Value for use in the Filter Pills area
     *
     * @param mixed $value
     * @return array<mixed>|string|boolean|null
     */
    public function getFilterPillValue($value): array|string|bool|null
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item)
                        ?? (new Collection($this->getOptions()))
                            ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$item]
                        ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }

    /**
     * Checks if the Filter Value is empty
     *
     * @param mixed $value
     * @return boolean
     */
    public function isEmpty(mixed $value): bool
    {
        if (! is_array($value)) {
            return true;
        } elseif (in_array('all', $value)) {
            return true;
        }

        return false;
    }
}
