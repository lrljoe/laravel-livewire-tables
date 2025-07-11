/*jshint esversion: 6 */

function stringFilter() {

    Alpine.data('stringFilter', (wire,filterKey,dataTableFingerprint,defaultValue) => ({
        stringFilterKey: filterKey,
        value: null, 
        setValue: null,
        toggleStatusWithReset()
        {
            window.filterPopoverOpen = false;
            wire.call('resetFilter',this.stringFilterKey);
        },
        init() { 
            this.$nextTick(() => { 
                this.value = wire.get('appliedFilters.'+this.stringFilterKey) ?? defaultValue;
                this.setValue = wire.get('appliedFilters.'+this.stringFilterKey) ?? null;
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {

                    if(detail.dataTableFingerprint == dataTableFingerprint && detail.filterKey == this.stringFilterKey) { 
                        this.value = detail.value; 
                        this.setValue = detail.value;
                    }
                })
            );
        },
        destroy() {
            this.listeners.forEach((listener) => {
                listener();
            });
        },
    }));
}

export default stringFilter;