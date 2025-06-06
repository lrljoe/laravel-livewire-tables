<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasBulkActionsStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsCheckboxAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsThAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsThCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsTdAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsTdCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $bulkActionsRowButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>|null
     */
    protected ?array $bulkActionsMenuTransitionAttributes;

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
     * Undocumented function
     *
     * @return ComponentAttributeBag
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
        if($this->isTailwind() || $this->isTailwind4())
        {
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
     * Used to get attributes for the <th> for Bulk Actions
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsThAttributes(): array
    {
        return $this->getCustomAttributesNew('bulkActionsThAttributes', true, true);

    }

    /**
     * Used to check if the Bulk Actions TH has any attributes (supports historic approach)
     */
    #[Computed]
    public function hasBulkActionsThAttributes(): bool
    {
        return $this->getBulkActionsThAttributes() != ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Used to get attributes for the Checkbox for Bulk Actions TH
     *
     * @return array<mixed>
     */
    public function getBulkActionsThCheckboxAttributes(): array
    {
        return array_merge([
            ':checked' => 'selectedItems.length == paginationTotalItemCount',
            'type' => 'checkbox',
            'x-init' => '$watch(\'indeterminateCheckbox\', value => $el.indeterminate = value); $watch(\'selectedItems\', value => newSelectCount = value.length);',
            'x-on:click' => 'if(selectedItems.length == paginationTotalItemCount) { $el.indeterminate = false; $wire.clearSelected(); bulkActionHeaderChecked = false; } else { bulkActionHeaderChecked = true; $el.indeterminate = false; $wire.setAllSelected(); }',
        ],$this->getCustomAttributesNew('bulkActionsThCheckboxAttributes', true, true));

    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsTdAttributes(): array
    {
        return $this->getCustomAttributesNew('bulkActionsTdAttributes', true, true);
    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsTdCheckboxAttributes(): array
    {
        return array_merge(
            [
                'x-model' => 'selectedItems',
                'wire:loading.attr.delay' => 'disabled',
                'type' => 'checkbox',
            ],
            $this->getCustomAttributesNew('bulkActionsTdCheckboxAttributes', true, true)
        );
    }

    /**
     * Used to get attributes for the Bulk Actions Row Buttons
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsRowButtonAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsRowButtonAttributes', true);

    }

    #[Computed]
    public function getBulkActionsRowButtonAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getBulkActionsRowButtonAttributes());
    }

    /**
     * Used to set attributes for the Bulk Actions Menu Button
     *
     * @param array<mixed> $bulkActionsButtonAttributes
     * @return self
     */
     public function setBulkActionsButtonAttributes(array $bulkActionsButtonAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsButtonAttributes', $bulkActionsButtonAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu
     *
     * @param array<mixed> $bulkActionsMenuAttributes
     * @return self
     */
     public function setBulkActionsMenuAttributes(array $bulkActionsMenuAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuAttributes', $bulkActionsMenuAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu Items
     *
     * @param array<mixed> $bulkActionsMenuItemAttributes
     * @return self
     */
    public function setBulkActionsMenuItemAttributes(array $bulkActionsMenuItemAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuItemAttributes', $bulkActionsMenuItemAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions TD in the Row
     *
     * @param array<mixed> $bulkActionsTdAttributes
     * @return self
     */
    public function setBulkActionsTdAttributes(array $bulkActionsTdAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsTdAttributes', $bulkActionsTdAttributes);

    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the Row
     *
     * @param array<mixed> $bulkActionsTdCheckboxAttributes
     * @return self
     */
    public function setBulkActionsTdCheckboxAttributes(array $bulkActionsTdCheckboxAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsTdCheckboxAttributes', $bulkActionsTdCheckboxAttributes);
    }

    /**
     * Used to set attributes for the <th> for Bulk Actions
     *
     * @param array<mixed> $bulkActionsThAttributes
     * @return self
     */
    public function setBulkActionsThAttributes(array $bulkActionsThAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsThAttributes', $bulkActionsThAttributes);
    }

    /**
     *  Used to set attributes for the Bulk Actions Checkbox in the <th>
     *
     * @param array<mixed> $bulkActionsThCheckboxAttributes
     * @return self
     */
    public function setBulkActionsThCheckboxAttributes(array $bulkActionsThCheckboxAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsThCheckboxAttributes', $bulkActionsThCheckboxAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Row Buttons
     *
     * @param array<mixed> $bulkActionsRowButtonAttributes
     * @return self
     */
    public function setBulkActionsRowButtonAttributes(array $bulkActionsRowButtonAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsRowButtonAttributes', $bulkActionsRowButtonAttributes);
    }
}
