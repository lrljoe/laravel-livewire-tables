<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\{IsColumn};
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults\HasDefaultStringValue;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\ObscureColumnHelpers;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\ObscureColumnConfiguration;

class ObscureColumn extends Column
{
    use HasDefaultStringValue,
        ObscureColumnHelpers,
        ObscureColumnConfiguration;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = 'livewire-tables::includes.columns.obscure';
    
    /**
     * The mask used
     * 
     * @var string
     */
    public string $mask = "*********";

    /**
     * Obscuration Configuration
     *
     * @var array<string,bool|string|array<mixed>>
     */
    public array $obscureSettings = [
        'enabled' => true,
        'defaultClickEnabled' => true,
        'wrapperAttributes' => ['x-data' => "{ obscure: true }"],
        'customAttributes' => [],
    ];

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
        $this->unclickable()
            ->setShouldObscureEnabled()
            ->setupObscuration();

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
            ->withValue($this->getValue($row))
            ->withMask($this->mask)
            ->withObscureAttributes($this->getObscureContentAttributes());
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
