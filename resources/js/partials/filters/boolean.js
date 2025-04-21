/*jshint esversion: 6 */

function newBf() {

    Alpine.data('newBooleanFilter', (filterKey,tableName,defaultValue) => ({
        booleanFilterKey: filterKey,
        switchOn: false, 
        value: false, 
        toggleStatus()
        {
            let tempValue = Boolean(Number(this.$wire.get('filterComponents.'+this.booleanFilterKey) ?? this.value));
            let newBoolean = !tempValue;
            this.switchOn = this.value = newBoolean;
            return Number(newBoolean);
        },
        toggleStatusWithUpdate()
        {
            let newValue = this.toggleStatus();
            this.$wire.set('filterComponents.'+this.booleanFilterKey, newValue);
        },
        toggleStatusWithReset()
        {
            let newValue = this.toggleStatus();
            this.$wire.call('resetFilter',this.booleanFilterKey);
        },
        setSwitchOn(val)
        {
            let number = Number(val ?? 0);
            this.switchOn = Boolean(number); 
        },
        init() { 

            this.$nextTick(() => { 
                this.value = this.$wire.get('filterComponents.'+this.booleanFilterKey) ?? defaultValue;
                this.setSwitchOn(this.value ?? 0);
            });

            this.listeners.push(
                Livewire.on('filter-was-set', (detail) => {
                    if(detail.tableName == this.tableName && detail.filterKey == this.booleanFilterKey) { 
                        this.switchOn = detail.value ?? defaultValue; 
                    }
                })
            );
        }
    }));
}

export default newBf;