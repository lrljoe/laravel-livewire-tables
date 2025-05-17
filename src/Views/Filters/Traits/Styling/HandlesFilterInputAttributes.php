<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;


trait HandlesFilterInputAttributes
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterInputAttributes = [];

    /**
     * Undocumented function
     *
     * @return ComponentAttributeBag
     */
    public function getInputAttributesBag(): ComponentAttributeBag
    {
        $attributes = array_merge($this->getCoreInputAttributes(), $this->getInputAttributes());
        ksort($attributes);

        return new ComponentAttributeBag($attributes);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getInputAttributes(): array
    {
        return $this->filterInputAttributes;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getCoreInputAttributes(): array
    {
        return [
            'id' => $this->getGenericDisplayData()['tableName'].'-filter-'.$this->getKey().($this->hasCustomPosition() ? '-'.$this->getCustomPosition() : ''),
            'default-styling' => true,
            'default-colors' => true,
        ];
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $filterInputAttributes
     * @return self
     */
    public function setInputAttributes(array $filterInputAttributes): self
    {
        $this->filterInputAttributes = array_merge([
            'default-styling' => false,
            'default-colors' => false,
        ], $filterInputAttributes);

        return $this;
    }
}
