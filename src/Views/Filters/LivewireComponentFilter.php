<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasWireables, IsLivewireComponentFilter};

class LivewireComponentFilter extends Filter
{
    use HasWireables;
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
    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-filter';

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string|boolean
     */
    public function validate(string $value): string|bool
    {
        return $value;
    }

    /**
     * Undocumented function
     *
     * @param string|null $value
     * @return boolean
     */
    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     *
     * @return string|null
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
