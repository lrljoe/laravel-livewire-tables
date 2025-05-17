<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasToolsStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $toolsAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $toolBarAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    
    
    /**
     * Undocumented function
     * #[Computed]
     * @return array<mixed>
     */
    public function getToolsAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolsAttributes', default: false, classicMode: false);
    }

    /**
     * Undocumented function
     * #[Computed]
     * @return ComponentAttributeBag
     */
    public function getToolsAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolsAttributes());
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function getToolBarAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolBarAttributes', default: false, classicMode: false);
    }

    
    /**
     * Undocumented function
     *     #[Computed]

     * @return ComponentAttributeBag
     */
    public function getToolBarAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolBarAttributes());

    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $toolsAttributes
     * @return self
     */
    public function setToolsAttributes(array $toolsAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'toolsAttributes', customAttributes: $toolsAttributes);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $toolBarAttributes
     * @return self
     */
    public function setToolBarAttributes(array $toolBarAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'toolBarAttributes', customAttributes: $toolBarAttributes);

        return $this;
    }
}
