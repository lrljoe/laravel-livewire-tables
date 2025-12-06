<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasWireables, IsLivewireComponentFilter};

class LivewireComponentFilter extends Filter
{
    use HasWireables;
    use IsLivewireComponentFilter;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'blur';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-filter';

    /**
     * Validates that the value received by the Filter is valid, in this case - it is always valid unless empty
     */
    public function validate(string $value): string|bool
    {
        return $value;
    }

    /**
     * Checks if the Filter Value is empty
     */
    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
