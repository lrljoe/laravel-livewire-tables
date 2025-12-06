---
title: Styling
weight: 4
---

The Menu utilises the AlpineJS Anchor plugin (which uses the Floating UI project), to ensure correct responsive behaviour of the menu.

## setColumnSelectButtonAttributes
Allows for customisation of the appearance of the "Column Select" button

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

### default-colors
Setting to false will disable the default colors for the Column Select button, the default colors are:

Bootstrap: None

Tailwind: `text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600`

### default-styling
Setting to false will disable the default styling for the Column Select button, the default styling is:

Bootstrap: `btn dropdown-toggle d-block w-100 d-md-inline`

Tailwind: `inline-flex justify-center px-4 py-2 w-full text-sm font-medium rounded-md border shadow-sm focus:ring focus:ring-opacity-50`

```php
public function configure(): void
{
  $this->setColumnSelectButtonAttributes([
    'class' => 'focus:border-rose-300 focus:ring-1 focus:ring-rose-300 focus-visible:outline-rose-300', // Add these classes to the column select button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```


## setColumnSelectMenuAttributes
Allows for customisation of the appearance of the "Column Select" menu

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

```php
public function configure(): void
{
  $this->setColumnSelectMenuAttributes([
    'class' => 'text-rose-300 focus:border-rose-300 focus:ring-rose-300', // Add these classes to the column select menu option checkbox
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

## setColumnSelectMenuAttributes Transition Behaviour

To modify the transition behaviour, you can customise any of the x-transition properties, which by default are:
```php
    'x-transition:enter' => 'transition ease-out duration-100',
    'x-transition:enter-start' => 'transform opacity-0 scale-95',
    'x-transition:enter-end' => 'transform opacity-100 scale-100',
    'x-transition:leave' => 'transition ease-in duration-75',
    'x-transition:leave-start' => 'transform opacity-100 scale-100',
    'x-transition:leave-end' => 'transform opacity-0 scale-95',
```
By replacing the relevant attribute, for example, this would slow the "enter" behaviour to 3000ms instead of the default 100ms.

```php
public function configure(): void
{
  $this->setColumnSelectMenuAttributes([
    'x-transition:enter' => 'transition ease-out duration-200',
    'default-colors' => true, // Output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

## setColumnSelectMenuOptionCheckboxAttributes
Allows for customisation of the appearance of the "Column Select" menu option checkbox

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

### default-colors
Setting to false will disable the default colors for the Column Select menu option checkbox, the default colors are:

Bootstrap: None

Tailwind: `text-indigo-600 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600`

### default-styling

Setting to false will disable the default styling for the Column Select menu option checkbox, the default styling is:

Bootstrap 4: None

Bootstrap 5: `form-check-input`

Tailwind: `transition duration-150 ease-in-out rounded shadow-sm focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait`

```php
public function configure(): void
{
  $this->setColumnSelectMenuOptionCheckboxAttributes([
    'class' => 'text-rose-300 focus:border-rose-300 focus:ring-rose-300', // Add these classes to the column select menu option checkbox
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```
