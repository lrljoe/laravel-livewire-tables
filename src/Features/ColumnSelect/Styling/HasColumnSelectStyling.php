<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasColumnSelectStyling
{
    /**
     * Column Select Button Attributes
     *
     * @var array<mixed>
     */
    
    protected array $columnSelectButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Column Select Menu Option Checkbox Attributes
     *
     * @var array<mixed>
     */
    protected array $columnSelectMenuOptionCheckboxAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true, 'type' => 'checkbox', 'wire:loading.attr' => 'disabled'];

    /**
     * Column Select Menu Attributes
     *
     * @var array<mixed>
     */
    protected array $columnSelectMenuAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];

    /**
     * Use the New Column Select Design
     *
     * @var boolean
     */
    protected bool $useModernColumnSelect = false;

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getColumnSelectButtonAttributes(): array
    {
        return $this->columnSelectButtonAttributes;
    }

    #[Computed]
    public function getColumnSelectMenuAttributes(): array
    {
        return [...$this->getCoreTransitionAttributes(), ...$this->columnSelectMenuAttributes];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getColumnSelectMenuOptionCheckboxAttributes(): array
    {
        if($this->modernColumnSelect())
        {
            return $this->columnSelectMenuOptionCheckboxAttributes;
        }
        else
        {
            return [...['wire:model.live' => 'selectedColumns'], ...$this->columnSelectMenuOptionCheckboxAttributes];
        }

    }

    /**
     * Set Column Select Menu Attributes
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setColumnSelectMenuAttributes(array $attributes = []): self
    {

        $this->columnSelectMenuAttributes = [...$this->columnSelectMenuAttributes, ...$attributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setColumnSelectButtonAttributes(array $attributes = []): self
    {
        $this->columnSelectButtonAttributes = [...$this->columnSelectButtonAttributes, ...$attributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setColumnSelectMenuOptionCheckboxAttributes(array $attributes = []): self
    {
        $this->columnSelectMenuOptionCheckboxAttributes = [...$this->columnSelectMenuOptionCheckboxAttributes, ...$attributes];

        return $this;
    }


    #[Computed]
    public function modernColumnSelect(): bool
    {
        return $this->useModernColumnSelect;
    }

    /**
     * Set using modern column select
     *
     * @param boolean $status
     * @return self
     */
    protected function setModernColumnSelectStatus(bool $status): self
    {
        $this->useModernColumnSelect = $status;

        return $this;
    }
    
    /**
     * Set using modern column select enabled
     *
     * @return self
     */
    protected function setModernColumnSelectEnabled(): self
    {
        return $this->setModernColumnSelectStatus(true);
    }

    /**
     * Set using modern column select disabled
     *
     * @return self
     */
    protected function setModernColumnSelectDisabled(): self
    {
        return $this->setModernColumnSelectStatus(false);
    }
}
