<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasOptions, HasWireables, IsArrayFilter, IsLivewireComponentFilter};

class LivewireComponentArrayFilter extends Filter
{
    use HasWireables;
    use IsArrayFilter;
    use HasOptions;
    use IsLivewireComponentFilter;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'blur';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-array-filter';

    /**
     * Validates that the value received by the Filter is valid, in this case - it is always valid unless empty
     *
     * @param  array<mixed>  $value
     * @return array<mixed>|bool
     */
    public function validate(array $value): array|bool
    {
        if (! $this->isEmpty($value)) {
            return $value;
        }

        return [];
    }

    /**
     * Checks if the Filter Value is empty
     *
     * @param  array<mixed>  $value
     */
    public function isEmpty(array $value = []): bool
    {
        return empty($value) || (count($value) == 1 && (is_null($value[0]) || $value[0] == '' || $value[0] == 'null'));
    }

    /**
     * Gets the Default Value for this Filter via the Component
     *
     * @return array<mixed>
     */
    public function getFilterDefaultValue(): array
    {
        return [];
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
        foreach ($value as $key => $item) {

            $found = $this->getCustomFilterPillValue($item) ?? ($this->options[$item] ?? $item);
            if ($found) {
                $values[] = $found;
            }
        }

        return $values;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return array_keys($this->options ?? []);
    }
}
