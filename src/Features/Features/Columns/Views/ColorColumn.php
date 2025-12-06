<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\ColorColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults\HasDefaultStringValue;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\ColorColumnHelpers;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\IsColumn;

class ColorColumn extends Column
{
    use ColorColumnConfiguration,
        ColorColumnHelpers,
        HasDefaultStringValue;

    /**
     * Undocumented variable
     */
    public ?\Closure $colorCallback;

    /**
     * Undocumented variable
     */
    protected string $view = 'livewire-tables::includes.columns.color';

    /**
     * Undocumented function
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }

    }

    /**
     * Undocumented function
     */
    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->getColumnViewWithDefaults()
            ->withColor($this->getColor($row))
            ->withAttributeBag($this->getAttributeBag($row));
    }

    /**
     * Undocumented function
     */
    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }
}
