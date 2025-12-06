---
title: Events
weight: 3
---


## ColumnsSelected

If using column selection, an event is triggered when a user is changing selection. This can for example be used to store the selected columns in database for the user. When the user is accessing same page with the table, read som database and set the session key to initialize selected columns.

### Here is an example

```php
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ColumnsSelected::class => [
            DataTableColumnsSelectedListener::class
        ]
    ]
}
```

```php

class DataTableColumnsSelectedListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {   
        Setting::setCurrentUserTableColumns($event->key, $event->columns);     
    }

}
```
