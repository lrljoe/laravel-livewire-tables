<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search\Styling;

use Livewire\Attributes\Computed;

trait HasSearchIcon
{
    protected bool $searchIconSet = false;

    protected ?string $searchIcon = null;

    protected array $searchIconAttributes = ['class' => 'h-4 w-4', 'style' => 'color: #000000'];

    
    /**
     * Undocumented function
     * #[Computed]
     * @return boolean
     */
    public function hasSearchIcon(): bool
    {
        return $this->searchIconSet;
    }

    /**
     * Undocumented function
     * #[Computed]
     * @return string
     */
    public function getSearchIcon(): string
    {
        return $this->hasSearchIcon() ? $this->searchIcon : 'heroicon-m-magnifying-glass';
    }

    /**
     * Undocumented function
     * #[Computed]
     * @return string
     */
    public function getSearchIconClasses(): string
    {
        return $this->getSearchIconAttributes()['class'];

    }

    /**
     * Undocumented function
     * #[Computed]
     * @return array
     */
    public function getSearchIconAttributes(): array
    {
        return $this->searchIconAttributes;
    }

    /**
     * Undocumented function
     * #[Computed]
     * @return array
     */
    public function getSearchIconOtherAttributes(): array
    {
        return collect($this->getSearchIconAttributes())->except('class')->toArray();
    }

    protected function setSearchIconStatus(bool $searchIconStatus): self
    {
        $this->searchIconSet = $searchIconStatus;

        return $this;
    }

    protected function searchIconEnabled(): self
    {
        return $this->setSearchIconStatus(true);
    }

    protected function searchIconDisabled(): self
    {
        return $this->setSearchIconStatus(false);
    }

    protected function setSearchIcon(string $searchIcon): self
    {
        $this->searchIcon = $searchIcon;

        return $this->searchIconEnabled();
    }

    protected function setSearchIconAttributes(array $searchIconAttributes): self
    {
        $this->searchIconAttributes = array_merge($this->searchIconAttributes, $searchIconAttributes);

        return $this->searchIconEnabled();
    }
}
