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
        childElementOpen: false,
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        paginationCurrentCount: wire.entangle('paginationCurrentCount'),
        paginationTotalItemCount: wire.entangle('paginationTotalItemCount'),
        paginationCurrentItems: wire.entangle('paginationCurrentItems'),
        selectedItems: wire.entangle('selected'),
        selectAllStatus: wire.entangle('selectAll'),
        delaySelectAll: wire.entangle('delaySelectAll'),
        hideBulkActionsWhenEmpty: wire.entangle('hideBulkActionsWhenEmpty'),
        dragging: false,
        reorderEnabled: false,
        sourceID: '',
        targetID: '',
        currentlyHighlightedElement: '',
        orderedRows: [],
        defaultReorderColumn: wire.entangle('defaultReorderColumn'),
        reorderStatus: wire.entangle('reorderStatus'),
        currentlyReorderingStatus: wire.entangle('currentlyReorderingStatus'),
        hideReorderColumnUnlessReorderingStatus: wire.entangle('hideReorderColumnUnlessReorderingStatus'),
        reorderDisplayColumn: wire.entangle('reorderDisplayColumn'),
        externalFilterPillsVals: wire.entangle('externalFilterPillsValues'),
        internalFilterPillsVals: wire.entangle('internalFilterPillsVals'),
        showFilterPillLabel: [],
        filterPillsSeparator: ', ',
        showFilterPillsSection: true,
        newSelectCount: 0, 
        indeterminateCheckbox: false, 
        bulkActionHeaderChecked: false,
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
        resetSpecificFilter(filterKey)
        {
            this.externalFilterPillsVals[filterKey] = [];
            wire.call('resetFilter',filterKey);
        },
        resetAllFilters()
        {
            this.externalFilterPillsVals = [];
            wire.call('setFilterDefaults');
        },
        setInternalFilterPillVal(filterKey, filterValues)
        {

            if(typeof(filterValues) !== 'undefined')
            {
                this.internalFilterPillsVals[filterKey] = filterValues;
            }
        },
        syncExternalFilterPillsValues(filterKey,filterValues) {
            this.externalFilterPillsVals[filterKey] = filterValues;
            this.showFilterPillLabel[filterKey] = this.getFilterPillsLength(filterKey);
        },
        getFilterPillsLength(filterKey)
        {
            return Object.keys(this.externalFilterPillsVals[filterKey]).length ?? 0;
        },
        showFilterPillsValue(filterKey, filterPillValue)
        {
            if(typeof(filterPillValue) !== "undefined")
            {
                this.externalFilterPillsVals[filterKey] = filterPillValue;
            }
            else
            {
                this.externalFilterPillsVals[filterKey] = null;
            }
            
        },
        setFilterPillsLength(externalFilterPillsValues)
        {
            let filterValueLength = 0;
            if (typeof(externalFilterPillsValues) !== 'undefined')
            {
                filterValueLength = Object.keys(externalFilterPillsValues).length ?? 0;
            }
            else
            {
                filterValueLength = 0;
            }
            return filterValueLength; 
        },
        showFilterPillsLabel(filterKey)
        {
            let pillsLength = this.getFilterPillsLength(filterKey);
            return (this.getFilterPillsLength(filterKey) > 0);
        },
        getFilterPillImplodedValues(filterKey, separator)
        {
            let filterPillValues = this.externalFilterPillsVals[filterKey];
            if(filterPillValues !== 'undefined')
            {
                let joinedValues = filterPillValues.join(separator);

                return joinedValues;
            }

            return '';
        },
        showFilterPillsSeparator(filterKey,index)
        {
            return ((index+1) < (this.getFilterPillsLength(filterKey)));
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
            wire.clearSelected();
        },
        selectAllOnPage() {
            if (!this.showBulkActionsAlpine) {
                return;
            }

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