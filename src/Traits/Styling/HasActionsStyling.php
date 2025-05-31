<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Computed;

trait HasActionsStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $actionWrapperAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];

    
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['class' => '', 'default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $actionWrapperAttributes
     * @return self
     */
    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...$this->actionWrapperAttributes, ...$actionWrapperAttributes];

        return $this;
    }
}
