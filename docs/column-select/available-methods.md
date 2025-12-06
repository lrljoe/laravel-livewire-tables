---
title: Available Methods
weight: 2
---


## setColumnSelectDelay

Set the delay when selecting Columns
```php
public function configure(): void
{
    // Defaults to 1500
    $this->setColumnSelectDelay(500);
}
```

## setDataTableFingerprint

In order to idenfify each table and prevent conflicts on column selection, each table is given a unique fingerprint.
This fingerprint is generated using the static::class name of the component. If you are reusing
the same component in different parts of your application, you may need to set your own custom fingerprint.

```php
public function configure(): void
{
    // Default fingerprint is output of protected method dataTableFingerprint()
    // Below will prepend the current route name
    $this->setDataTableFingerprint(route()->getName() . '-' . $this->dataTableFingerprint());
}
```

## Enabling/Disabling Column Select

You can enable/disable Column Select on a per-table basis:

### setColumnSelectStatus

**Enabled by default**, enable/disable column select for the component.

```php
public function configure(): void
{
    $this->setColumnSelectStatus(true);
    $this->setColumnSelectStatus(false);
}
```

### setColumnSelectEnabled

Enable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(true)
    $this->setColumnSelectEnabled();
}
```

### setColumnSelectDisabled

Disable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(false)
    $this->setColumnSelectDisabled();
}
```

## Responsive Visibility

You can show/hide the Column Select based on the device in use:

### setColumnSelectHiddenOnTablet

Hide column select menu when on tablet or mobile

```php
public function configure(): void
{
    $this->setColumnSelectHiddenOnTablet();
}
```

### setColumnSelectHiddenOnMobile

Hide column select menu when on mobile.

```php
public function configure(): void
{
    $this->setColumnSelectHiddenOnMobile();
}
```

## Remember Column Select

You can configure whether or not to persist the Column Selection for this table:

### setRememberColumnSelectionStatus

**Enabled by default**, whether or not to remember the users column select choices.

```php
public function configure(): void
{
    $this->setRememberColumnSelectionStatus(true);
    $this->setRememberColumnSelectionStatus(false);
}
```

### setRememberColumnSelectionEnabled

Remember the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(true)
    $this->setRememberColumnSelectionEnabled();
}
```

### setRememberColumnSelectionDisabled

Forget the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(false)
    $this->setRememberColumnSelectionDisabled();
}
```