<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HandlesWildcardStrings, HasWireables, IsStringFilter};

class TextFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;
    use HandlesWildcardStrings;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.text-field';

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string|boolean
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
     * @return array<mixed>
     */
    protected function getCoreInputAttributes(): array
    {
        $attributes = array_merge(parent::getCoreInputAttributes(),
            [
                'type' => 'text',
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'maxlength' => $this->hasConfig('maxlength') ? $this->getConfig('maxlength') : null,
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'text'),

            ]);
        ksort($attributes);

        return $attributes;
    }
}
