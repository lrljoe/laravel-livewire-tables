<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;


trait HandlesFilterLabelAttributes
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterLabelAttributes = [];

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getFilterLabelAttributes(): array
    {
        $attributes = array_merge(['default-colors' => true, 'default-styling' => true], $this->filterLabelAttributes);
        ksort($attributes);

        return $attributes;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasFilterLabelAttributes(): bool
    {
        return $this->getFilterLabelAttributes() != ['default-colors' => true, 'default-styling' => true];
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $filterLabelAttributes
     * @return self
     */
    public function setFilterLabelAttributes(array $filterLabelAttributes): self
    {
        $this->filterLabelAttributes = [...['default-colors' => true, 'default-styling' => true], ...$filterLabelAttributes];

        return $this;
    }
}
