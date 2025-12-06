<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

class IncrementColumn extends Column
{
    protected string $view = 'livewire-tables::includes.columns.increment';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);

    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->getColumnViewWithDefaults()
            ->withColumn($this)
            ->withAttributeBag($this->getAttributeBag($row));
    }
}
