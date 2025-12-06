---
title: Multi-Select Filters
weight: 7
---

Multi-select filters are a list of checkboxes. The user can select multiple options from the list. There is also an 'All' option that will select all values.

```php
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectFilter;

public function filters(): array
{
    return [
        MultiSelectFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            ),
    ];
}
```

## Filter Pills Separator

As this filter returns one or more values, you have the option to utilise a custom separator for the values displayed in the Filter Pills section at the top of the table.  The default is ", ", but you may use any HTML string to separate the selected values

```php
public function filters(): array
{
    return [
        MultiSelectFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            )
            ->setPillsSeparator('<br />'),
    ];
}

```


## Additional Information
Ensure you check out:
- [Applying Filters](../filters/applying-filters) documentation for Applying Filters to your query cleanly
- [Available Filter Methods](../filters/available-filter-methods) documentation for more Filter Features
- [Filter Pills](../filters/filter-pills) documentation for help with configuring the pills for a filter
- [Available Component Methods](../filters/available-component-methods) documentation for Table Wide configuration