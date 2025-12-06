/*jshint esversion: 6 */

function tools() {
    Alpine.data('tools', (wire) => ({
        filtersOpen: wire.entangle('filterConfiguration.filterSlideDownDefaultVisible'),
        externalFilterPillsVals: wire.entangle('externalFilterPillsValues'),
        internalFilterPillsVals: wire.entangle('internalFilterPillsVals'),
        showFilterPillLabel: [],
        filterPillsSeparator: ', ',
        showFilterPillsSection: true,
        resetSpecificFilter(filterKey)
        {
            console.log("tools - resetSpecificFilter");
            this.internalFilterPillsVals[filterKey] = [];
            this.externalFilterPillsVals[filterKey] = [];
            wire.call('resetFilter',filterKey);
        },
        resetAllFilters()
        {
            this.externalFilterPillsVals = [];
            wire.dispatch('clear-filters');
            //wire.call('setFilterDefaults');
        },
        setInternalFilterPillVal(filterKey, filterValues)
        {
            console.log("tools - setInternalFilterPillVal");

            if(typeof(filterValues) !== 'undefined')
            {
                this.internalFilterPillsVals[filterKey] = filterValues;
            }
        },
        syncExternalFilterPillsOptions(eventFilterKey, eventFilterValues) {
            console.log('tools - syncExternalFilterPillsOptions');
            console.log('eventFilterValues Orig');
            console.log(this.externalFilterPillsOptions[eventFilterKey]);


            eventFilterValues.forEach((key, val) => {
                console.log('eventFilterValues ForEach');
                console.log('eventFilterKey: '+eventFilterKey);
                console.log('eventFilterValue key: '+key);
                console.log('eventFilterValue val: '+val);

                this.externalFilterPillsOptions[eventFilterKey][key] = val;
            });
                console.log('eventFilterValues New');

                console.log(this.externalFilterPillsOptions[eventFilterKey]);
        },
        syncExternalFilterPillsValues(filterKey,filterValues) {
            console.log("tools - syncExternalFilterPillsValues");

            console.log('tools - syncExternalFilterPillsValues - filterKey:'+filterKey);

            this.externalFilterPillsVals[filterKey] = filterValues;
            this.showFilterPillLabel[filterKey] = this.getFilterPillsLength(filterKey);
        },
        getFilterPillsLength(filterKey)
        {
            return Object.keys(this.externalFilterPillsVals[filterKey]).length ?? 0;
        },
        showFilterPillsValue(filterKey, filterPillValue)
        {
            console.log("tools - showFilterPillsValue - "+filterKey);

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
            console.log("tools - getFilterPillImplodedValues - "+filterKey);
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
        }

    }));
}

export default tools;