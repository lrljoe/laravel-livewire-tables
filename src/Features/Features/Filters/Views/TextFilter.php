<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{HandlesWildcardStrings, HasWireables, IsStringFilter};

class TextFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;
    use HandlesWildcardStrings;

    /**
     * Undocumented variable
     */
    public string $wireMethod = 'blur';

    /**
     * The path to the view for this filter
     */
    protected string $view = 'livewire-tables::components.tools.filters.text-field';

    /**
     * Validates that the value received by the Filter is valid
     */
    public function validate(string $value): string|bool
    {
        if ($this->hasConfig('maxlength')) {
            return strlen($value) <= $this->getConfig('maxlength') ? $value : false;
        }

        return strlen($value) ? $value : false;
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
                'type' => 'text',
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'maxlength' => $this->hasConfig('maxlength') ? $this->getConfig('maxlength') : null,
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'text'),
            ]
        );
    }
}
