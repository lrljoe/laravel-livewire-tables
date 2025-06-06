/*jshint esversion: 6 */

function table() {
    Alpine.data('laravellivewiretable', (wire) => ({
        tableId: '',
        showBulkActionsAlpine: false,
        primaryKeyName: '',
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        tableName: wire.entangle('tableName'),
        dataTableFingerprint: wire.entangle('dataTableFingerprint'),
        listeners: [],
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('bulkActionConfig.selectAll'),
        selectedAllOnPage: false,
        delaySelectAll: wire.entangle('bulkActionConfig.delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('bulkActionConfig.hideBulkActionsWhenEmpty'),
        reorderEnabled: false,
        defaultReorderColumn: wire.entangle('reorderConfig.defaultReorderColumn'),
        reorderStatus: wire.entangle('reorderConfig.reorderStatus'),
        currentlyReorderingStatus: wire.entangle('reorderConfig.currentlyReorderingStatus'),
        hideReorderColumnUnlessReorderingStatus: wire.entangle('reorderConfig.hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: wire.entangle('reorderConfig.reorderDisplayColumn'),
        newSelectCount: 0, 
        indeterminateCheckbox: false, 
        bulkActionHeaderChecked: false,
        currentOrderOfItems: null, 
        updateOrderOfItems(items) { 
            this.currentOrderOfItems = items; 
        }, 
        storeOrderedItems() { 
            wire.storeReorder(this.currentOrderOfItems) 
        },
        stripLivewireTags(data) { 
            let localHtml = data.innerHTML; 
            localHtml = localHtml.replace('<!--[if BLOCK]>', '')
                    .replace('<![endif]-->','')
                    .replace('<!--[if ENDBLOCK]>','')
                    .replace('<![endif]-->','')
                    .trim();
            return localHtml;
        },
        removeHTMLTags(htmlString) {
            // Create a new DOMParser instance
            const parser = new DOMParser();
            // Parse the HTML string
            let  doc = parser.parseFromString(htmlString, 'text/html');
            // Extract text content
            let textContent = doc.body.innerText || "";
            // Trim whitespace
            let trimmedContent = textContent.trim();

            return trimmedContent;
        },        
        reorderToggle() {
            if (this.currentlyReorderingStatus) {
                wire.disableReordering();
            }
            else {
                if (this.hideReorderColumnUnlessReorderingStatus) {
                    this.reorderDisplayColumn = true;
                }
                wire.enableReordering();
            }
        },
        cancelReorder() {
            if (this.hideReorderColumnUnlessReorderingStatus) {
                this.reorderDisplayColumn = false;
            }

            wire.disableReordering();
        },
        toggleSelectAll() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

            if (this.paginationTotalItemCount === this.selectedItems.length) {
                this.clearSelected();
                this.selectAllStatus = false;
            } else {
                if (this.delaySelectAll)
                {   
                    this.setAllItemsSelected();
                }
                else
                {
                    this.setAllSelected();
                }
            }
        },
        setAllItemsSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectedAllOnPage = true;
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
            this.selectedAllOnPage = false;
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!this.showBulkActionsAlpine) {
                return;
            }
            this.selectedAllOnPage = true;
            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        },
        setTableId(tableId)
        {
            this.tableId = tableId;
        },
        setAlpineBulkActions(showBulkActionsAlpine)
        {
            this.showBulkActionsAlpine = showBulkActionsAlpine;
        },
        setPrimaryKeyName(primaryKeyName)
        {
            this.primaryKeyName = primaryKeyName;
        },
        showTable(event)
        {
            let eventTableName = event.detail.tableName ?? '';
            let eventTableFingerprint = event.detail.tableFingerpint ?? '';

            if (((eventTableName ?? '') != '' && eventTableName === this.tableName) || (eventTableFingerprint != '' && eventTableFingerpint === this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = true; 
            } 
        },
        hideTable(event)
        {
            let eventTableName = event.detail.tableName ?? '';
            let eventTableFingerprint = event.detail.tableFingerpint ?? '';

            if ((eventTableName != '' && eventTableName === this.tableName) || (eventTableFingerprint != '' && eventTableFingerpint === this.dataTableFingerprint)) { 
                this.shouldBeDisplayed = false; 
            } 
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        },
    }));
}
export default table;