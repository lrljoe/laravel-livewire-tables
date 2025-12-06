<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search\Styling;

trait HasSearchInput
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $searchFieldAttributes = [];

    protected ?string $searchPlaceholder = null;

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    protected function setSearchFieldAttributes(array $attributes = []): self
    {
        $this->setCustomAttributes('searchFieldAttributes', array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], $attributes));

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSearchFieldAttributes(): array
    {
        return $this->getCustomAttributes('searchFieldAttributes', true);
    }

    public function setSearchPlaceholder(string $placeholder): self
    {
        $this->searchPlaceholder = $placeholder;

        return $this;
    }

    public function getSearchPlaceholder(): string
    {
        if ($this->hasSearchPlaceholder()) {
            return $this->searchPlaceholder;
        }

        return __($this->getLocalisationPath().'Search');
    }

    public function hasSearchPlaceholder(): bool
    {
        return $this->searchPlaceholder !== null;
    }
    
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getSearchViewAttributes(): array
    {
        return [
            'hasSearch' => $this->hasSearch(),
            'icon' => [
                'classes' => $this->getSearchIconClasses(),
                'hasSearchIcon' => $this->hasSearchIcon(),
                'searchIcon' => $this->getSearchIcon(),
                'otherAttributes' => $this->getSearchIconOtherAttributes(),
            ],
            'searchFieldAttributes' => $this->getSearchFieldAttributes(),           
            'searchOptions' => $this->getSearchOptions(),
            'searchPlaceholder' => $this->getSearchPlaceholder(),
        ];
    }
}
