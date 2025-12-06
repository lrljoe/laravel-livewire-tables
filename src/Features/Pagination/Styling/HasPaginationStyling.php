<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pagination\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasPaginationStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $paginationWrapperAttributes = ['class' => ''];

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getPerPageFieldAttributes(): array
    {
        return $this->perPageFieldAttributes;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getPaginationWrapperAttributes(): array
    {
        return $this->paginationWrapperAttributes ?? ['class' => ''];
    }

    public function getPaginationWrapperAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getPaginationWrapperAttributes());
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $attributes
     */
    public function setPerPageFieldAttributes(array $attributes = []): self
    {
        $this->perPageFieldAttributes = [...$this->perPageFieldAttributes, ...$attributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $paginationWrapperAttributes
     */
    public function setPaginationWrapperAttributes(array $paginationWrapperAttributes): self
    {
        $this->paginationWrapperAttributes = array_merge(['class' => ''], $paginationWrapperAttributes);

        return $this;
    }
}
