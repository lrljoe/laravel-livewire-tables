<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Views\Traits;

use Illuminate\View\ComponentAttributeBag;

trait HasActionAttributes
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $actionAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $actionAttributes
     */
    public function setActionAttributes(array $actionAttributes): self
    {
        $this->actionAttributes = [...$this->actionAttributes, ...$actionAttributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getActionAttributes(): array
    {
        $actionAttributes = [...['class' => '', 'default-colors' => true, 'default-styling' => true], ...$this->actionAttributes];

        if (! $this->hasWireAction()) {
            $actionAttributes['href'] = $this->getRoute();
        } else {
            $actionAttributes['href'] = '#';
            $actionAttributes[$this->getWireAction()] = $this->getWireActionParams();
            if ($this->getWireNavigateEnabled()) {
                $actionAttributes['wire:navigate'] = '';
            }
        }

        return $actionAttributes;
    }

    public function getActionAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getActionAttributes());
    }
}
