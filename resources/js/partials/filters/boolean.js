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
                    console.log('filter-was-set-in-boolean');
                    console.log('detail');
                    console.log(detail);

                    if(detail.tableName == tableName && detail.filterKey == this.booleanFilterKey) { 
                        console.log('applies-to-this-table');
                        console.log('typeof');
                        console.log(typeof detail.value);
                        console.log(detail.value);

                        if(typeof detail.value === null || detail.value === null)
                        {
                            console.log("Null Setting to False");
                            this.value = this.switchOn = false; 
                        }
                        else
                        {
                            let number = Number(detail.value ?? 0);
                            let boolVal = Boolean(number);
                            console.log("Setting to "+boolVal);
                            this.value = this.switchOn = boolVal; 
                            this.setSwitchOn(number);
                        }
                    }
                })
            );
        }
    }));
}

export default newBf;