<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasToolBarStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $toolBarAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getToolBarAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolBarAttributes', default: false, classicMode: false);
    }

    
    /**
     * Undocumented function
     *     #[Computed]

     * @return ComponentAttributeBag
     */
    #[Computed]
    public function getToolBarAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolBarAttributes());

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
