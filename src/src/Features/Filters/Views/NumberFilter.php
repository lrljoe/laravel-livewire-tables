<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HasWireables, IsNumericFilter};

class NumberFilter extends Filter
{
    use IsNumericFilter;
    use HasWireables;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'blur';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.number';

    /**
     * Validates that the value received by the Filter is valid
     *
     * @param  float|int|string|array<mixed>  $value
     */
    public function validate(float|int|string|array $value): float|int|string|false
    {
        $floatValue = (float) $value;
        $intValue = (int) $value;

        if (is_array($value)) {
            return false;
        } elseif (is_float($value)) {
            return $floatValue;
        } elseif (is_int($value)) {
            return $intValue;
        } elseif (is_numeric($value)) {
            return (($floatValue - $intValue) == 0) ? $intValue : $floatValue;
        } elseif (ctype_digit($value)) {
            return $intValue;
        }

        return false;
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
                'min' => $this->hasConfig('min') ? $this->getConfig('min') : null,
                'max' => $this->hasConfig('max') ? $this->getConfig('max') : null,
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'type' => 'number',
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'number'),
            ]
        );
    }
}
