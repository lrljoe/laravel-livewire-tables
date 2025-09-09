/*jshint esversion: 6 */

function columnSelect() {
    Alpine.data('columnSelect', (wire) => ({
            open: false, 
            childElementOpen: false, 
            updatingRoot: false,
            previousCols: [],
            selectableCols: wire.entangle('columnSelectConfig.selectableColumns'),
            selectableColumnCount: wire.entangle('columnSelectConfig.selectableColumnCount'),
            selectedCols: wire.entangle('selectedColumns'),
            timeout: 0,
            toggleAll()
            {
                this.open = false;
                wire.call('toggleAllColumns');
            },
            checkShouldSendUpdate()
            {
                if(this.selectedCols.length != this.previousCols.length)
                {
                    return true;
                }

                for (let i = 0; i < this.selectedCols.length; i++) {
                    if (this.selectedCols[i] !== this.previousCols[i]) {
                        return true;
                    }
                }

                return false;
            },
            sendUpdate()
            {
                if(this.checkShouldSendUpdate())
                {
                    this.previousCols = this.selectedCols;
                    this.open = false;
                    wire.$refresh();
                }
            },
            init()
            {
                this.$nextTick(() => { 
                    let preCol = wire.get('selectedColumns');
                    this.previousCols = preCol;
                });
            }

    }));
}

export default columnSelect;