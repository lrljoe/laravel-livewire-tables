/*jshint esversion: 6 */

function tableWrap() {
    Alpine.data('tableWrapper', (wire, showBulkActionsAlpine) => ({
        shouldBeDisplayed: wire.entangle('shouldBeDisplayed'),
        listeners: [],
        paginationCurrentCount: wire.entangle('paginationConfig.paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationConfig.paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationConfig.paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('bulkActionConfig.selectAll'),
        delaySelectAll: wire.entangle('bulkActionConfig.delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('bulkActionConfig.hideBulkActionsWhenEmpty'),
        toggleSelectAll() {
            if (!showBulkActionsAlpine) {
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
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = true;
            this.selectAllOnPage();
        },
        setAllSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            if (this.delaySelectAll)
            {   
                this.selectAllStatus = true;
                this.selectAllOnPage();
            }
            else
            {
                wire.setAllSelected();
            }
        },
        clearSelected() {
            if (!showBulkActionsAlpine) {
                return;
            }
            this.selectAllStatus = false;
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!showBulkActionsAlpine) {
                return;
            }

            let tempSelectedItems = this.selectedItems;
            const iterator = this.paginationCurrentItems.values();
            for (const value of iterator) {
                tempSelectedItems.push(value.toString());
            }
            this.selectedItems = [...new Set(tempSelectedItems)];
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        }
    }));

}

export default tableWrap;