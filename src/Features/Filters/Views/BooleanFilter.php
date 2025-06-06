<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\HasWireables;

class BooleanFilter extends Filter
{
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
    protected string $view = 'livewire-tables::components.tools.filters.boolean';

    /**
     * Undocumented function
     *
     * @param string $name
     * @param string|null $key
     */
    public function __construct(string $name, ?string $key = null)
    {
        parent::__construct($name,$key);
    }


    /**
     * Undocumented function
     *
     * @param boolean|integer|string|null $value
     * @return boolean
     */
    public function validate(bool|int|string|null $value): bool
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
            $value = (bool) $value;
        }

        if (is_bool($value)) {
            return $value;
        }

        return false;
    }

    /**
     * Undocumented function
     *
     * @param mixed $value
     * @return array<mixed>|string|boolean|null
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
        return !empty($this->filterPillValues) ? $this->filterPillValues : [
            true => __('livewire-tables::core.Enabled'),
            false => __('livewire-tables::core.Disabled'),
        ];
    }


    /**
     * Undocumented function
     *
     * @param boolean|integer|string|null $value
     * @return boolean
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
     * Undocumented function
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
     *
     * @return boolean|null
     */
    public function getFilterDefaultValue(): ?bool
    {
        return $this->filterDefaultValue ?? null;
    }
}
