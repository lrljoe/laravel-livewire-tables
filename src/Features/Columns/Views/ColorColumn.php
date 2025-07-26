<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\ColorColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\{IsColumn};
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\ColorColumnHelpers;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults\HasDefaultStringValue;

class ColorColumn extends Column
{
    use ColorColumnConfiguration,
        ColorColumnHelpers,
        HasDefaultStringValue;

    /**
     * Undocumented variable
     *
     * @var \Closure|null
     */
    public ?\Closure $colorCallback;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::includes.columns.color';

    /**
     * Undocumented function
     *
     * @param string $title
     * @param string|null $from
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
     *
     * @param Model $row
     * @return null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->getColumnViewWithDefaults()
            ->withColor($this->getColor($row))
            ->withAttributeBag($this->getAttributeBag($row));
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @return string
     */
    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }
}
