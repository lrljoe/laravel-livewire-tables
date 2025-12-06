<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\HasWireables;

class BooleanFilter extends Filter
{
    use HasWireables;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'live';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.boolean';

    /**
     * Undocumented function
     */
    public function __construct(string $name, ?string $key = null)
    {
        parent::__construct($name, $key);
    }

    /**
     * Validate the input from the Boolean Filter - ensuring that it is an acceptable boolean
     */
    public function validate(bool|int|string|null $value): int|bool
    {
        if ($value === null) {
            return false;
        } elseif (is_string($value)) {
            if ($value == '0' || $value == '1') {
                $value = (int) $value;
            } else {
                return false;
            }
        }
        if (is_int($value) && ($value == 0 || $value == 1)) {
            return $value;
        }

        if (is_bool($value)) {
            return (int) $value;
        }

        return false;
    }

    /**
     * Retrieves the Filter Value for use in the Filter Pills area
     *
     * @param  mixed  $value
     * @return array<mixed>|string|bool|null
     */
    public function getFilterPillValue($value): array|string|bool|null
    {
        return $this->getCustomFilterPillValue($value);
    }

    /**
     * Retrieves Custom Filter Pills Values for this Filter
     *
     * @return array<mixed>
     */
    public function getCustomFilterPillValues(): array
    {
        return ! empty($this->filterPillValues) ? $this->filterPillValues : [
            true => __('livewire-tables::core.Enabled'),
            false => __('livewire-tables::core.Disabled'),
        ];
    }

    /**
     * Checks if the Filter Value is empty
     */
    public function isEmpty(bool|int|string|null $value): bool
    {
        if (is_null($value)) {
            return true;
        } elseif (is_string($value)) {
            return $value != '0' && $value != '1';
        } elseif (is_int($value)) {
            return $value != 0 && $value != 1;
        } elseif (is_bool($value)) {
            return false;
        }

        return true;
    }

    /**
     * Retrieves the Input Attributes for the HTML Input box
     *
     * @return array<string,mixed>
     */
    protected function getCoreInputAttributes(): array
    {
        return $this->mergeCoreInputAttributes(
            [
                '@click' => 'toggleStatusWithUpdate',
                'activeColor' => 'bg-blue-600',
                'blobColor' => 'bg-white',
                'inactiveColor' => 'bg-neutral-200',
                'type' => 'button',
                'x-ref' => 'switchButton',
            ]
        );
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?bool
    {
        return $this->filterDefaultValue ?? null;
    }
}
