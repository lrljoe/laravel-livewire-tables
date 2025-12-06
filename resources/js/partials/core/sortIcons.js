/*jshint esversion: 6 */

function sortIcons() {


    Alpine.data('sortIcons', () => ({
        isAsc(direction) { return direction == 'asc'; }, 
        isDesc(direction) { return direction == 'desc'; }, 
        isUnsorted(direction) { return (!this.isAsc(direction) && !this.isDesc(direction)); }, 
        checkSort(direction) { 
            if(direction == 'asc')
            {
                return 'asc';
            }
            else if(direction == 'desc')
            {
                return 'desc';
            }
            else
            {
                return 'unsorted';
            }
        },
        nextSort(direction) { 
            if (this.isAsc(direction)) {
                return 'desc'; 
            } 
            else if (this.isDesc(direction)) {
                return 'none'; 
            } 
            else { 
                return 'asc'; 
            }
        },
    }));
}

export default sortIcons;