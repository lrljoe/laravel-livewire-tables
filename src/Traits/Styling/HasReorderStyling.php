<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Computed;

trait HasReorderStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $reorderThAttributes = ['default' => true];
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $reorderButtonStartAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button', 'x-on:click' => 'reorderToggle'];
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $reorderButtonSaveAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button', 'x-on:click' => 'storeOrderedItems'];
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $reorderButtonCancelAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button', 'x-on:click' => 'reorderToggle'];

    /**
     * Used to get attributes for the <th> for Reorder
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getReorderThAttributes(): array
    {
        return $this->reorderThAttributes ?? ['default' => true];
    }

    #[Computed]
    public function hasReorderThAttributes(): bool
    {
        return $this->getReorderThAttributes() != ['default' => true];
    }

    /**
     * Used to set attributes for the <th> for Reorder Column
     */
    /**
     * Undocumented function
     *
     * @param array<mixed> $reorderThAttributes
     * @return self
     */
     public function setReorderThAttributes(array $reorderThAttributes): self
    {
        $this->reorderThAttributes = [...$this->reorderThAttributes, ...$reorderThAttributes];

        return $this;
    }

    /**
     * Used to get attributes for the buttons for Reorder
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getReorderButtonStartAttributes(): array
    {
        return $this->reorderButtonStartAttributes;
    }

    #[Computed]
    public function hasReorderButtonStartAttributes(): bool
    {
        return $this->getReorderButtonStartAttributes() != ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button'];
    }

    /**
     * Used to set attributes for the Reorder Buttons
     */
    /**
     * Undocumented function
     *
     * @param array<mixed> $reorderButtonStartAttributes
     * @return self
     */
     public function setReorderButtonStartAttributes(array $reorderButtonStartAttributes): self
    {
        $this->reorderButtonStartAttributes = [...$this->reorderButtonStartAttributes, ...$reorderButtonStartAttributes];

        return $this;
    }

    /**
     * Used to get attributes for the buttons for Reorder Save
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getReorderButtonSaveAttributes(): array
    {
        return $this->reorderButtonSaveAttributes;
    }

    #[Computed]
    public function hasReorderButtonSaveAttributes(): bool
    {
        return $this->getReorderButtonSaveAttributes() != ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button'];
    }

    /**
     * Used to set attributes for the Reorder Save Button
     */
    /**
     * Undocumented function
     *
     * @param array<mixed> $reorderButtonSaveAttributes
     * @return self
     */
     public function setReorderButtonSaveAttributes(array $reorderButtonSaveAttributes): self
    {
        $this->reorderButtonSaveAttributes = [...$this->reorderButtonSaveAttributes, ...$reorderButtonSaveAttributes];

        return $this;
    }

    /**
     * Used to get attributes for the buttons for Reorder Cancel
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getReorderButtonCancelAttributes(): array
    {
        return $this->reorderButtonCancelAttributes;
    }

    /**
     * Determines if ReorderButtonCancelAttributes Have Been Set
     *
     * @return boolean
     */
    #[Computed]
    public function hasReorderButtonCancelAttributes(): bool
    {
        return $this->getReorderButtonCancelAttributes() != ['class' => '', 'default-colors' => true, 'default-styling' => true, 'type' => 'button'];
    }

    /**
     * Used to set attributes for the Reorder Cancel Button
     */
    /**
     * Undocumented function
     *
     * @param array<mixed> $reorderButtonCancelAttributes
     * @return self
     */
     public function setReorderButtonCancelAttributes(array $reorderButtonCancelAttributes): self
    {
        $this->reorderButtonCancelAttributes = [...$this->reorderButtonCancelAttributes, ...$reorderButtonCancelAttributes];

        return $this;
    }

    /**
     * Gets Reorder Button Attributes
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getAllReorderButtonAttributes(): array
    {
        return [
            'start' => $this->getReorderButtonStartAttributes(),
            'save' => $this->getReorderButtonSaveAttributes(),
            'cancel' => $this->getReorderButtonCancelAttributes(),
        ];
    }

}