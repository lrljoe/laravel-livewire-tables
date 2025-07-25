---
title: Column Selection
weight: 5
---

Column select is on by default for each Column, with default behaviours.

To customise the Column Select behaviours globally, see [Column Select](../column-select/about).

To customise specific Column's "Column Select" behaviour, see the below:

## Configuring a Custom Column Select String

By default, the Column Select dropdown will utilise the Column's "Title" as the displayed text for the option.  You can use this method to specify a custom string to be used instead:

```php
Column::make('Address', 'address.address')
    ->setColumnSelectTitle("The User's Address"),
```

## Column Select Visibility

By default, all Columns are included in the Column Select dropdown.  You can change this behaviour using the following methods:

### Excluding from Column Select

If you don't want a column to be able to be turned on/off from the column select box, you may exclude it.  This will remove the option to enable/disable this Column from the dropdown:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect(),
```

### Deselected by default

If you would like a column to be included in the Column Select but deselected by default, you can specify:

```php
Column::make('Address', 'address.address')
    ->deselected(),
```

### DeselectedIf

If you would like a column to be included in the column select but deselected based on an external parameter/callback, you may use this approach.

Returning "true" will deselect the Column by default, returning "false" will select the Column by default

```php
Column::make('Address', 'address.address')
    ->deselectedIf(fn() => 2 > 1),
```

or

```php
Column::make('Address', 'address.address')
    ->deselectedIf(!Auth::user()),
```

### SelectedIf

If you would like a column to be included in the column select and selected based on an external parameter/callback, you may use this approach.

Returning "true" will select the Column by default, returning "false" will deselect the Column by default

```php
Column::make('Address', 'address.address')
    ->selectedIf(fn() => 2 > 1),
```
or

```php
Column::make('Address', 'address.address')
    ->selectedIf(Auth::user()),
```
