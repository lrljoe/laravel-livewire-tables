<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasOptions, HasWireables, IsArrayFilter, IsLivewireComponentFilter};

class LivewireComponentArrayFilter extends Filter
{
    use HasWireables;
    use IsArrayFilter;
    use HasOptions;
    use IsLivewireComponentFilter;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $wireMethod = 'blur';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-array-filter';

    /**
     * Undocumented function
     *
     * @param array<mixed> $value
     * @return array<mixed>|boolean
     */
    public function validate(array $value): array|bool
    {
        if (! $this->isEmpty($value)) {
            return $value;
        }

        return [];
    }

    
    /**
     * Undocumented function
     *
     * @param array<mixed> $value
     * @return boolean
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
     * Undocumented function
     *
     * @param mixed$value
     * @return array<mixed>|string|boolean|null
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
