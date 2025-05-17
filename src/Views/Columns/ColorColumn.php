<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ColorColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\{HasDefaultStringValue, IsColumn};
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\ColorColumnHelpers;

class ColorColumn extends BaseColumn
{
    use ColorColumnConfiguration,
        ColorColumnHelpers;
    use HasDefaultStringValue;

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
