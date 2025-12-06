<?php

namespace Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\Styling;

trait HasLoadingPlaceholderStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $loadingPlaceHolderAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $loadingPlaceHolderIconAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $loadingPlaceHolderWrapperAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $loadingPlaceHolderRowAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $loadingPlaceHolderCellAttributes = ['class' => '', 'default' => true];

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getLoadingPlaceholderAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderAttributes', default: true, classicMode: true);

    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getLoadingPlaceHolderIconAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderIconAttributes', default: true, classicMode: true);

    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getLoadingPlaceHolderWrapperAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: true, classicMode: true);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getLoadingPlaceHolderRowAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: true, classicMode: true);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getLoadingPlaceHolderCellAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderCellAttributes', default: true, classicMode: true);

    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setLoadingPlaceHolderAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setLoadingPlaceHolderIconAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderIconAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderIconAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setLoadingPlaceHolderRowAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderRowAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderRowAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    /**
     * Returns an array of Loading Placeholder relevant information for use in loading
     *
     * @return array<mixed>
     */
    protected function getLoadingPlaceHolderDetails(): array
    {
        return [
            'loaderRow' => $this->getLoadingPlaceHolderRowAttributes(),
            'loaderCell' => $this->getLoadingPlaceHolderCellAttributes(),
            'loaderIcon' => $this->getLoadingPlaceHolderIconAttributes(),
            'hasLoadingPlaceholderBlade' => $this->hasLoadingPlaceholderBlade(),
            'loadingPlaceHolderBlade' => $this->getLoadingPlaceHolderBlade() ?? '' ,
            'loadingPlaceholderContent' => $this->getLoadingPlaceholderContent(),
        ];
    }
}
