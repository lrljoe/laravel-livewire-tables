---
title: Multi-Select Dropdown Filters
weight: 6
---

Multi-select dropdown filters are a simple dropdown list. The user can select multiple options from the list. There is also an 'All' option that will select all values

```php
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\MultiSelectDropdownFilter;

public function filters(): array
{
    return [
        MultiSelectDropdownFilter::make('Tags')
            ->options(
                Tag::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            )
            ->setFirstOption('All Tags'),
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