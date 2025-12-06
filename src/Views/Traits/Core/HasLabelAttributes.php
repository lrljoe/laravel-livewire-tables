<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Features\Core\HandlesCoreAttributes;

trait HasLabelAttributes
{
    use HandlesCoreAttributes;

    /**
     * Undocumented variable
     *
     * @var array<mixed>|null
     */
    protected ?array $labelAttributesArray;

    /**
     * Undocumented function
     */
    public function hasLabelAttributes(): bool
    {
        return $this->hasCustomAttributes('labelAttributesArray');
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     *
     * @return array<mixed>
     */
    public function getLabelAttributes(): array
    {
        return $this->getCustomAttributes('labelAttributesArray');
    }

    /**
     * Undocumented function
     */
    public function getLabelAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getLabelAttributes());
    }

    /**
     * Set a list of attributes to override on the th label
     *
     * @param  array<mixed>  $labelAttributes
     */
    public function setLabelAttributes(array $labelAttributes): self
    {
        $this->setCustomAttributes('labelAttributesArray', $labelAttributes);

        return $this;
    }

    /**
     * Set a list of attributes to override on the th label
     *
     * @param  array<mixed>  $labelAttributes
     */
    public function labelAttributes(array $labelAttributes): self
    {
        $this->setCustomAttributes('labelAttributesArray', $labelAttributes);

        return $this;
    }
}
