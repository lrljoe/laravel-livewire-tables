---
title: Collapsing
weight: 7
---


## Collapsing

The component has the ability to collapse certain columns at different screen sizes. It will add a plus icon as the left most column that will open up a view below the row with the information of the collapsed columns:

![Collapsing](https://imgur.com/z1rWHzP.png)

You have 3 options when it comes to collapsing.

Collapse Always:

```php
Column::make('Name')
    ->collapseAlways(),
```
The columns will always be collapsed

Collapse on tablet:

```php
Column::make('Name')
    ->collapseOnTablet(),
```

The columns will collapse on tablet and mobile.

Collapse on mobile:

```php
Column::make('Name')
    ->collapseOnMobile(),
```

The column will collapse on mobile only.

The view will be rendered with the order of the columns as they were initially shown.
