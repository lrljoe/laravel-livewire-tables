<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling;

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
        return [...['default' => true], ...$this->filterLabelAttributes];
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasFilterLabelAttributes(): bool
    {
        return $this->getFilterLabelAttributes() != ['default' => true] && $this->getFilterLabelAttributes() != ['default' => false];
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $filterLabelAttributes
     * @return self
     */
    public function setFilterLabelAttributes(array $filterLabelAttributes): self
    {
        $this->filterLabelAttributes = [...['default' => false], ...$filterLabelAttributes];

        return $this;
    }
}
