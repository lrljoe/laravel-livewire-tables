<?php

namespace Rappasoft\LaravelLivewireTables\Features\Tools\Styling;

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
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getToolsAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolsAttributes', default: false, classicMode: false);
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function getToolsAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolsAttributes());
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $toolsAttributes
     */
    public function setToolsAttributes(array $toolsAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'toolsAttributes', customAttributes: $toolsAttributes);

        return $this;
    }
}
