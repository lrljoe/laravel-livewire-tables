<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\IconColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\IconColumnHelpers;

class IconColumn extends Column
{
    use IconColumnConfiguration,
        IconColumnHelpers;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    public ?Closure $iconCallback;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::includes.columns.icon';

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

        $this->html();
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @return null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $attributeBag = $this->getAttributeBag($row);

        return $this->getColumnViewWithDefaults()
            ->withIcon($this->getIcon($row))
            ->withClasses($attributeBag['class'])
            ->withAttributes(collect($attributeBag)->except('class')->toArray());
    }
}
