---
title: Number Columns
weight: 15
---

Number Columns are Standard Columns, with the difference being that the defaultValue expects and returns a numeric value, rather than a string, and the Sorting Pills default to Numeric Behaviour (0-9, 9-0).

```php
NumberColumn::make('Likes', 'likes')
    ->defaultValue('0') // Can be a string, int, or float
    ->sortable(),
```


Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>