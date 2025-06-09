---
title: ToolBar
weight: 3
---

The Toolbar provides several key features:

| Item | Purpose |
| --- | --- |
| 'bulk-actions' | The Bulk Actions dropdown - if Bulk Actions are defined, then this displays a list of the Bulk Actions |
| 'column-select' | Column Select dropdown - allowing for toggling visibility of a Column |
| 'filters' | The Filters Button - toggling the display of the Filters popover/slidedown |
| 'pagination-dropdown' | The Pagination dropdown, allowing for adjustment of per-page |
| 'reorder' | The Reorder Button - if reordering is enabled |
| 'search' | The Search Input -if one or more Columns are configured as searchable |



## Component Available Methods

### setToolBarEnabled
The Default Behaviour, ToolBar is Enabled.  But will only be rendered if there are available/enabled elements
```php
    public function configure(): void
    {
        $this->setToolBarEnabled();
    }
```

### setToolBarDisabled
Disables the Toolbar, which contains the Reorder, Filters, Search, Column Select, Pagination buttons/options.  Does not impact the Filter/Sort pills (if enabled)
```php
    public function configure(): void
    {
        $this->setToolBarDisabled();
    }
```


### Customising the Order:

You can add/remove items or change the order within the Toolbar Sections:

| Item | Purpose |
| --- | --- |
| 'bulk-actions' | The Bulk Actions dropdown |
| 'column-select' | The Column Select dropdown |
| 'filters' | The Filters Button |
| 'pagination-dropdown' | The Pagination dropdown |
| 'reorder' | The Reorder Button |
| 'search' | The Search Input |

Note that these sections are prepended/appended with the relevant configurableArea, and Actions in the Toolbar are placed appropriately.

Should you wish to modify the order, then keep in mind the following defaults:

#### Defaults
##### The Left Toolbar Elements
By default, the following is returned.
```php
    public function toolbarItemsLeft()
    {
        return ['reorder','search','filters'];
    }
```

##### The Right Toolbar Elements
By default, the following is returned:
```php
    public function toolbarItemsRight()
    {
        return ['bulk-actions','column-select','pagination-dropdown'];
    }
```

#### Example
This example moves the "bulk actions" dropdown to the left of the toolbar, and the "search" to the right of the toolbar.

```php
    public function toolbarItemsLeft()
    {
        // Instead Of
        // return ['reorder','search','filters'];
        return ['reorder','bulk-actions','filters'];
    }

    public function toolbarItemsRight()
    {
        // Instead Of
        // ['bulk-actions','column-select','pagination-dropdown'];
        return ['search','column-select','pagination-dropdown'];
    }
```

#### Example 2
This example adds an extra instance of the "search" input on the right side of the Toolbar

```php

    public function toolbarItemsRight()
    {
        return ['search','bulk-actions','column-select','pagination-dropdown'];
    }
```