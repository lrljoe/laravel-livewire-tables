/*jshint esversion: 6 */
import reorder from "./partials/core/reorder.min.js";
import table from "./partials/core/table.min.js";
import tableWrap from "./partials/core/tableWrap.min.js";
import filterPills from "./partials/core/filterPills.min.js";
import externalFilter from "./partials/core/externalFilter.min.js";


import boolean from "./partials/filters/boolean.js";
import fpf from "./partials/filters/fpf.js";
import nrF from "./partials/filters/numberRange.js";

document.addEventListener('alpine:init', () => {
    
    table();
    tableWrap();
    filterPills();
    reorder();
    externalFilter();

    boolean();
    fpf();
    nrF();
    
});