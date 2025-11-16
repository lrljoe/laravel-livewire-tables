---
title: Searching
weight: 10
---

## Searching

See also [component search configuration](../search/available-methods).

To enable searching you can chain the `searchable` method on your column:

```php
Column::make('Name')
    ->searchable(),
```

You can override the default search query using a closure:

```php
Column::make('Name')
    ->searchable(
        fn(Builder $query, $searchTerm) => $query->orWhere()
    ),
```
