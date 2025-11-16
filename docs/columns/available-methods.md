---
title: Available Methods
weight: 3
---

## Styling

To change the CSS classes or other attributes assigned to a Column, use can use [setTdAttributes](../datatable/styling), which allows customising attributes based on column type, name or value.



## Formatting

By default, the component will use the column value as the cell value.

You can either modify that value or bypass it entirely.

### Modifying the column value

If you would like to modify the value of the column, you can chain the `format` method, note that the column must exist.

```php
Column::make('Name', 'first_name')
    ->format(
        fn($value, $row, Column $column) => $row->first_name . ' ' . $row->last_name
    ),
```

### Rendering HTML

If you would like to return HTML from the format method you may:

```php
Column::make('Name')
    ->format(
        fn($value, $row, Column $column) => '<strong>'.$row->name.'</strong>'
    )
    ->html(),
```

And this method is also available for the [LinkColumn](./other-column-types#content-link-columns)

```php
LinkColumn::make('Name', 'name')
    ->title(fn ($row) => 'Title')
    ->location(fn ($row) => "#$row->id")
    ->html(),
```

### Using a view

If you would like to render a view for the cell:

```php
Column::make('Name')
    ->format(
        fn($value, $row, Column $column) => view('my.custom.view')->withValue($value)
    ),
```

As a shorthand you can use the following:

```php
Column::make('Name')
    ->view('my.custom.view'),
```

You will have access to `$row`, `$value`, and `$column` from within your view.

## Labels

If you have a column that is not associated with a database column, you can chain the `label` method:

```php
Column::make('My one off column')
    ->label(
        fn($row, Column $column) => $this->getSomeOtherValue($row, $column)
    ),
```

You can return HTML:

```php
Column::make('My one off column')
    ->label(
        fn($row, Column $column)  => '<strong>'.$row->this_other_column.'</strong>'
    )
    ->html(),
```

You can also return a view:

```php
Column::make('My one off column')
    // Note: The view() method is reserved for columns that have a field
    ->label(
        fn($row, Column $column) => view('my.other.view')->withRow($row)
    ),
```

Note that any field not used elsewhere in the table, that is required (for example creating an attribute based on two unused fields, these must be added to the query with setAdditionalSelects() in the configure() method (See Here)[https://rappasoft.com/docs/laravel-livewire-tables/v3/datatable/available-methods#content-builder])
```php
    public function configure(): void
    {
        $this->setAdditionalSelects(['users.forename as forename', 'users.surname as surname']);
    }
```

You can then use the fields:
```php
Column::make('My one off column')
    ->label(
        fn($row, Column $column)  => $row->forename.' '.$row->surname
    )
    ->html(),
```



## Misc.

### Eager Loading Relationships

If you need the access the relationships on the model from a format call or something of the like, you can eager load the relationships so you are not adding more queries:

```php
Column::make('Address', 'address.address')
    ->eagerLoadRelations(), // Adds with('address') to the query
```

### Conditionally Hiding Columns

Sometimes you may want to hide columns based on certain conditions. You can use the `hideIf` method to conditionally hide columns:

```php
Column::make('Type', 'user.type')
    ->hideIf(request()->routeIs('this.other.route')),

Column::make('Last 4', 'card_last_four')
    ->hideIf(! auth()->user()->isAdmin()),
```

### Excluding from Column Select

If you don't want a column to be able to be turned off from the column select box, you may exclude it:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect()
```

### Preventing clicks if row URL is enabled

If you have row URLs enabled, but you have a specific column you do not want clickable, i.e. in the event there is something else clickable in that row, you may use the following:

```php
Column::make('Name')
    ->unclickable(),
```

See more in the [clickable rows documentation](../rows/clickable-rows).

### Custom Column Slugs

If you are using non-latin characters as the Column Title, you should set a latin character based slug for the column.  This must be unique for each Column using non-latin Title

```php
Column::make('地址', 'address.address')
    ->setCustomSlug('Address')
```

### Hiding Column Label

Labels are visible by default, but should you wish to hide the label from the table header, without impacting on wider table behaviour, you may implement the following method:
```php
Column::make('Name')
    ->setColumnLabelStatusDisabled()
```

### Displaying Column Label

Labels are visible by default, but should you wish to override a previous "hideColumnLabel()", you may implement the below method:

```php
Column::make('Name')
    ->setColumnLabelStatusEnabled()
```

### Hiding On Reorder

You may set a Column to be hidden when reordering, this is often effective when you have complex columns that are not relevant to reordering.

As pagination is disabled during reordering, returning a minimal set of columns dramatically improves efficiency.

By default, all Selected Columns are displayed when reordering.

```php
Column::make('Name')
    ->hideOnReorder()
```



## See Also
[Column Styling](./styling)

