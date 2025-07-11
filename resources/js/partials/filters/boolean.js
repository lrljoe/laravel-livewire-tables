/*jshint esversion: 6 */

function newBf() {

    Alpine.data('newBooleanFilter', (wire,filterKey,dataTableFingerprint,defaultValue) => ({
        booleanFilterKey: filterKey,
        switchOn: false, 
        value: false, 
        setValue: null,
        toggleStatus()
        {
            let tempValue = Boolean(Number(wire.get('appliedFilters.'+this.booleanFilterKey) ?? this.value));
            let newBoolean = !tempValue;
            this.switchOn = this.value = this.setValue = newBoolean;
            return Number(newBoolean);
        },
        toggleStatusWithUpdate()
        {
            let newValue = this.toggleStatus();
            wire.set('appliedFilters.'+this.booleanFilterKey, newValue);
        },
        toggleStatusWithReset()
        {
            let newValue = this.toggleStatus();
            wire.call('resetFilter',this.booleanFilterKey);
        },
        setSwitchOn(val)
        {
            let number = Number(val ?? 0);
            this.switchOn = Boolean(number); 
        },
        init() { 

            this.$nextTick(() => { 
                this.value = wire.get('appliedFilters.'+this.booleanFilterKey) ?? defaultValue;
                this.setValue = wire.get('appliedFilters.'+this.booleanFilterKey) ?? null;
                this.setSwitchOn(this.value ?? 0);
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {

                    if(detail.dataTableFingerprint == dataTableFingerprint && detail.filterKey == this.booleanFilterKey) { 

                        if(typeof detail.value === null || detail.value === null)
                        {
                            this.value = this.switchOn = false; 
                            this.setValue = detail.value;
                        }
                        else
                        {
                            let number = Number(detail.value ?? 0);
                            let boolVal = Boolean(number);
                            this.value = this.switchOn = this.setValue = boolVal; 
                            this.setSwitchOn(number);
                        }
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

export default newBf;