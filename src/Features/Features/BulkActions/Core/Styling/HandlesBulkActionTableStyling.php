<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Core\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HandlesBulkActionTableStyling
{
    /**
     * Attributes for the Bulk Actions TH
     *
     * @var array<mixed>
     */
    protected array $bulkActionsThAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Attributes for the Bulk Actions TH Checkboxes
     *
     * @var array<mixed>
     */
    protected array $bulkActionsThCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Attributes for the Bulk Actions TD
     *
     * @var array<mixed>
     */
    protected array $bulkActionsTdAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Attributes for the Bulk Actions TD Checkboxes
     *
     * @var array<mixed>
     */
    protected array $bulkActionsTdCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    /**
     * Attributes for the Bulk Actions Row Buttons
     *
     * @var array<mixed>
     */
    protected array $bulkActionsRowButtonAttributes = ['default-colors' => true, 'default-styling' => true];

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
     *
     * @return boolean
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

    /**
     * Used to get attributes for the Bulk Actions Row Buttons
     *
     * @return ComponentAttributeBag
     */
    #[Computed]
    public function getBulkActionsRowButtonAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getBulkActionsRowButtonAttributes());
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