---
title: Sorting
weight: 10
---

## Sorting

See also [component sorting configuration](../sorting/available-methods).

To enable sorting you can chain the `sortable` method on your column:

```php
Column::make('Name')
    ->sortable(),
```

If you would like more control over the sort behavior of a specific column, you may pass a closure:

```php
Column::make(__('Address'))
    ->sortable(
        fn(Builder $query, string $direction) => $query->orderBy()
    ),
```

### [Multi-column sorting](../sorting/available-methods#setsinglesortingstatus)

Multi-column sorting is **disabled by default**. To enable it you can set the `setSingleSortingDisabled()` method on the component.

```php
public function configure(): void
{
    $this->setSingleSortingDisabled();
}
```

Multi-column sorting is now enabled in the order the column headers are clicked.

### [Default column sorting](../sorting/available-methods#setdefaultsort)

By default, there is no default column sorting and the table will be displayed in the order the query has it listed. To enable default sorting you can use this method on your component:

```php
public function configure(): void
{
    $this->setDefaultSort('name', 'desc');
}
```



## Customization

### Customizing sorting pill names

You can customize the name on the pill for the specific column that's being sorted:

```php
Column::make('Name')
    ->setSortingPillTitle('Full Name'),
```

### Customizing sorting pill directions

You can customize the directions on the pill for the specific column that's being sorted:

```php
Column::make('Name')
    // Instead of Name: A-Z it will say Name: Asc
    ->setSortingPillDirections('Asc', 'Desc'),
```
