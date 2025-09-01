/*jshint esversion: 6 */

function filterPills() {
    Alpine.data('filterPillsHandler', (data) => ({
        localData: data,
        localFilterKey: '',
        localFilterTitle: '',
        isExternalFilter: false,
        shouldRenderAsHTML: false,
        shouldWatchPillValues: false,
        pillsSeparator: ',',
        pillValues: null,
        pillHasValues: false,
        displayString: '',
        generateLocalFilterPillImplodedValues(filterPillValues)
        {
            console.log('filterPillsHandler - generateLocalFilterPillImplodedValues');
            console.log(filterPillValues);

            if(typeof(filterPillValues) !== 'undefined')
            {
                var temporarySeparatorString = '---tablepillsseparator---';
                var regex = new RegExp(temporarySeparatorString, 'g');
                var joinedValues;

                if(Array.isArray(filterPillValues))
                {
                    joinedValues = filterPillValues.join(temporarySeparatorString);
                }
                else
                {
                    joinedValues = filterPillValues;    
                }

                if(!this.shouldRenderAsHTML)
                {
                    joinedValues = this.removeHTMLTags(joinedValues);
                }

                if (joinedValues !== null)
                {
                    let replacedJoinedValues = joinedValues.replace(regex, this.pillsSeparator);
                    return replacedJoinedValues;
    
                }
                return "";
            }
            return "";
        },
        clearExternalFilterPill()
        {
            if(this.isExternalFilter)
            {
                this.externalFilterPillsVals[this.localFilterKey] = [];
                this.displayString = this.generateLocalFilterPillImplodedValues(this.externalFilterPillsVals[this.localFilterKey]); 
                this.updatePillHasValues();
                this.resetSpecificFilter(this.localFilterKey);
            }
        },
        trigger: {
            ['@filterpillupdate.window'](event) {
                console.log('filterpillupdate');
                console.log(event);
                this.watchForUpdateEvent(event);
            },
        },
        checkEventIsValid(eventdataTableFingerprint, eventFilterKey)
        {
            console.log('localDataFingerprint: '+this.dataTableFingerprint);
            console.log('eventdataTableFingerprint: '+eventdataTableFingerprint);
            console.log('localFilterKey: '+this.localFilterKey);
            console.log('eventFilterKey: '+eventFilterKey);

            return ((this.dataTableFingerprint === eventdataTableFingerprint) && (this.localFilterKey === eventFilterKey));
        },
        watchForUpdateEvent(event)
        {
            console.log('filterPillsHandler - watchForUpdateEvent');

            if(this.checkEventIsValid(event.detail.dataTableFingerprint ?? '', event.detail.filterKey ?? ''))
            {
                console.log('filterPillsHandler - watchForUpdateEvent - Valid');

                let eventPillItem = event.detail.pillItem ?? '';
                if(!this.shouldRenderAsHTML)
                {
                    eventPillItem = this.removeHTMLTags(eventPillItem);
                }
    
                if(eventPillItem != "")
                {
                    if(this.isExternalFilter)
                    {
                        let filterPillValues = this.externalFilterPillsVals[this.localFilterKey];
    
                        filterPillValues.push(eventPillItem);
                        this.updatePillValues(filterPillValues);
                    }
                    else
                    {
                        this.updatePillValues(eventPillItem);
                    }    
                }
            }
            else
            {
                console.log('filterPillsHandler - watchForUpdateEvent - Invalid');
            }
        },
        updatePillValues(filterPillValues)
        {
            console.log('filterPillsHandler - updatePillValues');
            console.log(filterPillValues);

            this.pillValues = filterPillValues;
            this.displayString = this.generateLocalFilterPillImplodedValues(filterPillValues); 
            this.updatePillHasValues();

            return this.displayString;
        },
        updatePillHasValues()
        {
            this.pillHasValues = (this.displayString.length > 0);
        },
        init()
        {
            this.localFilterKey = this.localData['filterKey'] ?? 'unknown';
            this.localFilterTitle = this.localData['filterPillTitle'] ?? 'Unknown';
            this.pillsSeparator = this.localData['separator'] ?? ',';
            this.shouldWatchPillValues = Boolean(this.localData['watchForEvents'] ?? 0);
            this.isExternalFilter = Boolean(this.localData['isAnExternalLivewireFilter'] ?? 0);
            this.shouldRenderAsHTML = Boolean(this.localData['renderPillsAsHtml'] ?? 0);
            this.pillValues = this.localData['pillValues'] ?? null;

            this.$nextTick(() => { 
                if(this.isExternalFilter)
                {
                    console.log('isExternal Filter');
                    console.log('localFilterKey: '+ this.localFilterKey);
                    this.updatePillValues(this.externalFilterPillsVals[this.localFilterKey]);
                }
                else
                {
                    console.log('is NOT External Filter');
                    console.log('pillValues: '+ this.pillValues);

                    this.updatePillValues(this.pillValues);
                }
            });
            if(this.isExternalFilter && this.shouldWatchPillValues)
            {
                console.log('externalPillValsWatcher: '+this.localFilterKey);
                console.log('externalPillValsWatcher: '+this.localFilterKey);
                console.log('wired: '+'externalFilterPillsVals.'+this.localFilterKey);
                console.log('test: '+this.externalFilterPillsVals[this.localFilterKey]);

                this.$watch('externalFilterPillsVals.'+this.localFilterKey, filterPillValues => { 
                    this.updatePillValues(filterPillValues);
                });      
            }
        }
    }));

}

export default filterPills;