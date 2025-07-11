/*jshint esversion: 6 */

function nrF() {
    Alpine.data('numberRangeFilter', (wire, filterKey, dataTableFingerprint, parentElementPath, filterConfig, childElementRoot) => ({
        allFilters: wire.entangle('appliedFilters'),
        originalMin: 0,
        originalMax: 100,
        filterMin: 0,
        filterMax: 100,
        currentMin: 0,
        currentMax: 100,
        hasUpdate: false,
        listeners: [],
        wireValues: null,
        defaultMin: filterConfig['minRange'],
        defaultMax: filterConfig['maxRange'],
        restrictUpdates: false,
        initialiseStyles()
        {
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', this.wireValues['min'] ?? this.filterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', '"'+JSON.stringify(this.wireValues['min'] ?? this.filterMin)+'"');
            numRangeFilterContainer.style.setProperty('--value-b', this.wireValues['max'] ?? this.filterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(this.wireValues['max'] ?? this.filterMax));
        },
        updateStyles(filterMin, filterMax) {
            let tmpFilterMin = parseInt(filterMin);
            let tmpFilterMax = parseInt(filterMax);

            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', tmpFilterMin);
            numRangeFilterContainer.style.setProperty('--text-value-a', '"'+JSON.stringify(tmpFilterMin)+'"');
            numRangeFilterContainer.style.setProperty('--value-b', tmpFilterMax);
            numRangeFilterContainer.style.setProperty('--text-value-b', '"'+JSON.stringify(tmpFilterMax)+'"');
        },
        setupWire() {
            if (this.wireValues !== null) {
                this.filterMin = this.originalMin = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
                this.filterMax = this.originalMax = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
            } else {
                this.filterMin = this.originalMin = this.defaultMin;
                this.filterMax = this.originalMax = this.defaultMax;
            }
            this.updateStyles(this.filterMin, this.filterMax);
        },
        allowUpdates() {
            this.updateWire();
        },
        updateWire() {
            let tmpFilterMin = parseInt(this.filterMin);
            let tmpFilterMax = parseInt(this.filterMax);

            if (tmpFilterMin != this.originalMin || tmpFilterMax != this.originalMax) {
                if (tmpFilterMax < tmpFilterMin) {
                    this.filterMin = tmpFilterMax;
                    this.filterMax = tmpFilterMin;
                }
                this.hasUpdate = true;
                this.originalMin = tmpFilterMin;
                this.originalMax = tmpFilterMax;
            }
            this.updateStyles(this.filterMin,this.filterMax);
        },
        changeMin(value)
        {
            this.filterMin = value;
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-a', value);
            numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify(value));
        },
        changeMax(value)
        {
            this.filterMax = value;
            let numRangeFilterContainer = document.getElementById(parentElementPath);
            numRangeFilterContainer.style.setProperty('--value-b', value);
            numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify(value));
        },
        updateWireable() {
            if (this.hasUpdate) {
                this.hasUpdate = false;
                this.wireValues = { 'min': this.filterMin, 'max': this.filterMax };
                wire.set('appliedFilters.' + filterKey, this.wireValues);
            }
        },
        toggleStatusWithReset()
        {
            this.filterMin = this.defaultMin;
            this.filterMax = this.defaultMax;
            this.updateStyles(this.filterMin,this.filterMax);
            wire.call('resetFilter',filterKey);
        },
        init() {
            this.wireValues= wire.get('appliedFilters.' + filterKey) ?? { 'min': this.filterMin, 'max': this.filterMax };
            this.initialiseStyles();
            this.setupWire();
            this.$watch('allFilters', value => this.setupWire());
            this.listeners.push(
                Livewire.on('clear-filters', (detail) => {

                    if(detail.dataTableFingerprint == dataTableFingerprint && detail.filterKey == filterKey) { 
                        this.wireValues = { 'min': this.defaultMin, 'max': this.defaultMax };
                        this.updateStyles(this.defaultMin, this.defaultMax);

                    }
            }));
            this.listeners.push(

                Livewire.on('filter-was-set', (detail) => {

                    if(detail.dataTableFingerprint == dataTableFingerprint && detail.filterKey == filterKey) { 
                        this.wireValues = { 'min': this.defaultMin, 'max': this.defaultMax };
                        this.updateStyles(this.defaultMin, this.defaultMax);

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

export default nrF;