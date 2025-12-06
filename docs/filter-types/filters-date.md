---
title: Date Filters
weight: 3
---

Date filters are HTML date elements.

```php
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\DateFilter;

public function filters(): array
{
    return [
        DateFilter::make('Verified From'),
    ];
}
```

Date filters have configs to set min and max, to set the format for the Filter Pills, and to set a placeholder value

```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',  // Earliest Acceptable Date
                'max' => '2021-12-31', // Latest Acceptable Date
                'pillFormat' => 'd M Y', // Format for use in Filter Pills
                'placeholder' => 'Enter Date', // A placeholder value
            ])
    ];
}
```

## setFilterDefaultValue
Date filters also support the setFilterDefaultValue() method, which must be a valid date in the "Y-m-d" format.  This will apply as a default until removed.
```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',
                'max' => '2023-12-31',
                'pillFormat' => 'd M Y',
            ])->setFilterDefaultValue('2023-08-01')
    ];
}
```

## setPillsLocale        
Date Filters also support the setPillsLocale method, which allows you to set a locale for use in generating the Filter Pills values
```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->setPillsLocale('fr ') // Use French localisation for the Filter Pills values
            ->config([
                'min' => '2020-01-01',  // Earliest Acceptable Date
                'max' => '2021-12-31', // Latest Acceptable Date
                'pillFormat' => 'd M Y', // Format for use in Filter Pills
                'placeholder' => 'Enter Date', // A placeholder value
            ])
    ];
}
```

## Example
This example would return models with a "created_at" prior to the date specified in the Filter, with a maximum date of "today"
```php
public function filters(): array
{
    return [
            DateFilter::make('Item Created Before')
            ->config([
                'min' => '2020-01-01',
                'max' => \Carbon\Carbon::now()->format('Y-m-d'),
                'pillFormat' => 'd M Y',
            ])
            ->filter(function (Builder $builder, string $value) {
                return $builder->whereDate('created_at', '<=', $value);
            }),
    ];
}
```

The default wire behaviour is "live", to ensure quick response, but you are able to swap it to any wire method that you wish, for example, setting it to debounce with a 1000ms delay would look like:

```php
public function filters(): array
{
    return [
            DateFilter::make('Item Created Before')
            ->config([
                'min' => '2020-01-01',
                'max' => \Carbon\Carbon::now()->format('Y-m-d'),
                'pillFormat' => 'd M Y',
            ])
            ->filter(function (Builder $builder, string $value) {
                return $builder->whereDate('created_at', '<=', $value);
            })
            ->setWireDebounce(1000),
    ];
}
```
See the below "[Available Filter Methods](../filters/available-filter-methods)" for more wire options



## Additional Information
Ensure you check out:
- [Applying Filters](../filters/applying-filters) documentation for Applying Filters to your query cleanly
- [Available Filter Methods](../filters/available-filter-methods) documentation for more Filter Features
- [Filter Pills](../filters/filter-pills) documentation for help with configuring the pills for a filter
- [Available Component Methods](../filters/available-component-methods) documentation for Table Wide configuration