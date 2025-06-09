---
title: Introduction
weight: 1
---

Actions is a beta feature, that allows for the creation of Action Buttons that appear above the toolbar.  These are ideal for common Actions that do not impact existing records, such as a "Create", "Assign", "Back" buttons.

This is NOT recommended for production use at this point in time.

## Component Available Methods
### setActionWrapperAttributes

This is used to set attributes for the "div" that wraps all defined Action Buttons:

```php
    public function configure(): void
    {
        $this->setActionWrapperAttributes([
            'class' => 'space-x-4'
        ]);
    }
```

### setActionsInToolbarEnabled

Displays the Actions within the Toolbar.  Default is displaying above the Toolbar.

```php
    public function configure(): void
    {
        $this->setActionsInToolbarEnabled();
    }
```

### setActionsInToolbarDisabled

Displays the Actions above the Toolbar, default behaviour
```php
    public function configure(): void
    {
        $this->setActionsInToolbarDisabled();
    }
```


### setActionsLeft

Displays the Actions justified to the left

```php
    public function configure(): void
    {
        $this->setActionsLeft();
    }
```

### setActionsCenter

Displays the Actions justified to the center

```php
    public function configure(): void
    {
        $this->setActionsCenter();
    }
```

### setActionsRight

Displays the Actions justified to the right

```php
    public function configure(): void
    {
        $this->setActionsRight();
    }
```

### Example

The below would:
- Set your Actions as a "Dropdown"
- Add the Actions dropdown as a Toolbar item
- Set the Actions dropdown as a "right" item of the Toolbar.

```php
    public function configure(): void
    {
        $this->setActionsAsDropdownEnabled()
            ->setActionsInToolbarEnabled()
            ->setActionsRight();
    }
```
