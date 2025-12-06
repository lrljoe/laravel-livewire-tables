<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasBulkActionsStyling
{
    /**
     * Attributes for the Bulk Actions Checkbox
     *
     * @var array<mixed>
     */
    protected array $bulkActionsCheckboxAttributes = [];

    /**
     * Attributes for the Bulk Actions Menu
     *
     * @var array<mixed>
     */
    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Attributes for the Bulk Actions Menu Items
     *
     * @var array<mixed>
     */
    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Attributes for the Bulk Actions Menu Transition
     *
     * @var array<mixed>|null
     */
    protected ?array $bulkActionsMenuTransitionAttributes;

    /**
     * Attributes for the Bulk Actions Button
     *
     * @var array<mixed>
     */
    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Used to get attributes for the Bulk Actions Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsButtonAttributes(): array
    {
        return [...['x-ref' => 'bulkActionsButton', 'type' => 'button', 'aria-haspopup' => 'false'], ...(($this->isTailwind() || $this->isTailwind4()) ? ['x-on:click' => 'open = !open'] : ['data-toggle' => 'dropdown', 'data-bs-toggle' => 'dropdown']), ...$this->getCustomAttributes('bulkActionsButtonAttributes', true)];

    }

    /**
     * Used to get attributes for the Bulk Actions Button
     */
    #[Computed]
    public function getBulkActionsButtonAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getBulkActionsButtonAttributes());
    }

    /**
     * Used to get attributes for the Bulk Actions Menu (Dropdown)
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsMenuAttributes(): array
    {
        return [...$this->getCoreMenuAttributes(), ...(($this->isTailwind() || $this->isTailwind4()) ? ['x-anchor.bottom-start' => '$refs.bulkActionsButton'] : []), ...$this->getBulkActionsMenuTransitionAttributes(), ...$this->getCustomAttributes('bulkActionsMenuAttributes', true, false)];
    }

    /**
     * Gets Menu Transition Attributes
     *
     * @return array<mixed>
     */
    protected function getBulkActionsMenuTransitionAttributes(): array
    {
        if ($this->isTailwind() || $this->isTailwind4()) {
            return isset($this->bulkActionsMenuTransitionAttributes) ? $this->bulkActionsMenuTransitionAttributes : $this->getCoreTransitionAttributes();
        }

        return [];
    }

    /**
     * Used to get attributes for the items in the Bulk Actions Menu (Dropdown)
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsMenuItemAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsMenuItemAttributes', true, false);

    }

    /**
     * Used to set attributes for the Bulk Actions Menu Button
     *
     * @param  array<mixed>  $bulkActionsButtonAttributes
     */
    public function setBulkActionsButtonAttributes(array $bulkActionsButtonAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsButtonAttributes', $bulkActionsButtonAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu
     *
     * @param  array<mixed>  $bulkActionsMenuAttributes
     */
    public function setBulkActionsMenuAttributes(array $bulkActionsMenuAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuAttributes', $bulkActionsMenuAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu Items
     *
     * @param  array<mixed>  $bulkActionsMenuItemAttributes
     */
    public function setBulkActionsMenuItemAttributes(array $bulkActionsMenuItemAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuItemAttributes', $bulkActionsMenuItemAttributes);
    }
}
