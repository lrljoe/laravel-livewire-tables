---
title: ToolBar
weight: 3
---

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

Note that these sections are prepended/appended with the relevant configurableArea

#### Customising The Left Elements
By default, the following is returned.
```php
    public function toolbarItemsLeft()
    {
        return ['reorder','search','filters'];
    }
```

#### Customising The Right Elements
By default, the following is returned:
```php
    public function toolbarItemsRight()
    {
        return ['bulk-actions','column-select','pagination-dropdown'];
    }
```