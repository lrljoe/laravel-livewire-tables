<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasColumnSelectStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $columnSelectButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $columnSelectMenuOptionCheckboxAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

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

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getColumnSelectMenuOptionCheckboxAttributes(): array
    {
        return $this->columnSelectMenuOptionCheckboxAttributes;
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
}
