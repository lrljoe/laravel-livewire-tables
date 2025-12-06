---
title: Tools
weight: 2
---

## Component Available Methods

### setToolsEnabled
The Default Behaviour, Tools Are Enabled.  But will only be rendered if there are available/enabled elements.  If the Toolbar is enabled, this takes into account any Toolbar elements that are present.
```php
    public function configure(): void
    {
        $this->setToolsEnabled();
    }
```

### setToolsDisabled
Disables the Tools section, this includes the Toolbar, and Sort/Filter pills
```php
    public function configure(): void
    {
        $this->setToolsDisabled();
    }
```
