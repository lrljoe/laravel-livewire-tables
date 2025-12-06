---
title: Boolean Filters (beta)
weight: 2
---

## Beta
This is currently in beta, and will only work with Tailwind.

## Details

The BooleanFilter is designed so that you can toggle a more complex query/filter, as opposed to being a yes/no type of filter (which is what the SelectFilter is perfect for)

For example, your filter may look like this, toggling the filter from true to false would apply/not apply a more complex query to the query.

```php
    BooleanFilter::make('Limit to Older Enabled Users')
    ->filter(function (Builder $builder, bool $enabled) {
        if ($enabled)
        {
            $builder->where('status',true)->where('age', '>', 60);
        }
    })
```

Many of the standard methods are available, for example
```php
    BooleanFilter::make('Limit to Users Over 60')
    ->filter(function (Builder $builder, bool $enabled) {
        if ($enabled)
        {
            $builder->where('status',true)->where('age', '>', 60);
        }
    })
    ->setFilterPillValues([
        true => 'Active',
        false => 'Inactive',
    ])
    ->setFilterDefaultValue(true)
```

## Additional Information
Ensure you check out:
- [Applying Filters](../filters/applying-filters) documentation for Applying Filters to your query cleanly
- [Available Filter Methods](../filters/available-filter-methods) documentation for more Filter Features
- [Filter Pills](../filters/filter-pills) documentation for help with configuring the pills for a filter
- [Available Component Methods](../filters/available-component-methods) documentation for Table Wide configuration
