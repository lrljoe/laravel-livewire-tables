---
title: Styling
weight: 4
---

## Component Available Methods

### setToolsAttributes
Allows setting of attributes for the parent element in the tools blade

By default, this replaces the default classes on the tools blade, if you would like to keep them, set the default-colors/default-styling flags to true as appropriate

```php
    public function configure(): void
    {
       $this->setToolsAttributes(['class' => ' bg-green-500', 'default-colors' => false, 'default-styling' => true]);
    }
```

### setToolBarAttributes
Allows setting of attributes for the parent element in the toolbar blade.

By default, this replaces the default classes on the toolbar blade, if you would like to keep them, set the default-colors/default-styling flags to true as appropriate

```php
    public function configure(): void
    {
       $this->setToolBarAttributes(['class' => ' bg-red-500', 'default-colors' => false, 'default-styling' => true]);
    }
```
