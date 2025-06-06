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
     *
     * @var string
     */
    public string $wireMethod = 'blur';

    /**
     * Undocumented variable
     *
     * @var string
     */
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
