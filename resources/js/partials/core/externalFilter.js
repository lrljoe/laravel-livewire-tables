/*jshint esversion: 6 */

function externalFilter() {



    Alpine.data('tablesExternalFilter', (wire, filterKey) => ({
        externalFilterKey: filterKey,
        pillValues: [],
        optionsAvailable: wire.entangle('optionsAvailable'), 
        optionsSelected: wire.entangle('optionsSelected').live, 
        selectedItems: wire.entangle('selectedItems'), 
        sendValueToPill(value)
        {
            let sentValue = this.removeHTMLTags(value);
            this.$dispatch('filterpillupdate', { dataTableFingerprint: this.dataTableFingerprint, filterKey: this.externalFilterKey, pillItem: sentValue });
        },
        overridePill(values)
        {
            let sentValue = this.removeHTMLTags(values);
            this.$dispatch('filterpillupdate', { dataTableFingerprint: this.dataTableFingerprint, filterKey: this.externalFilterKey, pillItem: sentValue });
        },
        syncItems(items) { 
            this.pillValues = [];
            items.forEach((item) => {
                this.pillValues.push(this.optionsAvailable[item]);
            });
            if(this.pillValues.length > 0)
            {
                this.pillValues.sort();
                this.syncExternalFilterPillsValues(this.externalFilterKey,this.pillValues);
            }
            this.optionsSelected = this.selectedItems;
            wire.set('value', this.selectedItems);

        }, 
        init() { 
            this.selectedItems = this.optionsSelected;
            this.syncItems(this.selectedItems);
            this.$watch('selectedItems', value => this.syncItems(value)); 
        } 
    }));
}

export default externalFilter;