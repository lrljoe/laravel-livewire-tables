<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Computed;

trait HasSortingPillsStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $sortingPillsItemAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $sortingPillsClearSortButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $sortingPillsClearAllButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    
    /**
     * Undocumented function
     * #[Computed]
     * @return array<mixed>
     */
    public function getSortingPillsItemAttributes(): array
    {
        return $this->sortingPillsItemAttributes;
    }

    /**
     * Undocumented function
     *     #[Computed]
     * @return array<mixed>
     */
    public function getSortingPillsClearSortButtonAttributes(): array
    {
        return $this->sortingPillsClearSortButtonAttributes;
    }

    
    /**
     * Undocumented function
     * #[Computed]
     * @return array<mixed>
     */
    public function getSortingPillsClearAllButtonAttributes(): array
    {
        return $this->sortingPillsClearAllButtonAttributes;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setSortingPillsItemAttributes(array $attributes = []): self
    {
        $this->sortingPillsItemAttributes = [...$this->sortingPillsItemAttributes, ...$attributes];

        return $this;
    }

/**
 * Undocumented function
 *
 * @param array<mixed> $attributes
 * @return self
 */
    public function setSortingPillsClearSortButtonAttributes(array $attributes = []): self
    {
        $this->sortingPillsClearSortButtonAttributes = [...$this->sortingPillsClearSortButtonAttributes, ...$attributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setSortingPillsClearAllButtonAttributes(array $attributes = []): self
    {
        $this->sortingPillsClearAllButtonAttributes = [...$this->sortingPillsClearAllButtonAttributes, ...$attributes];

        return $this;
    }
}
