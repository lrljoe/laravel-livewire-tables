/*jshint esversion: 6 */

function toolbar() {
    Alpine.data('toolbar', (wire) => ({
        filtersOpen: wire.entangle('filterSlideDownDefaultVisible'),
        externalFilterPillsVals: wire.entangle('externalFilterPillsValues'),
        internalFilterPillsVals: wire.entangle('internalFilterPillsVals'),
        showFilterPillLabel: [],
        filterPillsSeparator: ', ',
        showFilterPillsSection: true,
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

    }));
}

export default toolbar;