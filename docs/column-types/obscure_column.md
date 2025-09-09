---
title: Obscure Columns
weight: 16
---

### Obscuring Values

If you would like to mask the data displayed for a given column, then you can utilise the new ObscureColumn.

This masks the data displayed, until the mask is clicked, at which point it displays as normal.

Note: The data is still returned, and accessible via the browser.  This *should not* be utilised to hide data from the end-user.  If this is required, then the format() method is recommended.

```php
ObscureColumn::make('Name', 'name')
```

Supported methods are:

### Default Click Behaviour
This is enabled by default when ObscureColumn is used.

#### setObscureDefaultClickBehaviourEnabled
Enables the default on-click toggle for the masking

#### setObscureDefaultClickBehaviourDisabled
Disables the default on-click toggle for the masking, you can utilise the Custom Attributes methods if you wish to customise the behaviour.

### Custom Mask
By default, the mask used is "*********", you can customise this using the setMask('') method:

```php
ObscureColumn::make('Name', 'name')
->setMask('####')
```


