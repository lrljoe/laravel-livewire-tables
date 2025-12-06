<?php

namespace Rappasoft\LaravelLivewireTables\Features\TableAttributes;

use Closure;
use Rappasoft\LaravelLivewireTables\Features\TableAttributes\Configuration\TableAttributeConfiguration;
use Rappasoft\LaravelLivewireTables\Features\TableAttributes\Helpers\TableAttributeHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\{HasCoreStyling, HasHeaderStyling};

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;
    use HasCoreStyling, HasHeaderStyling;

    /**
     * Undocumented variable
     */
    public bool $shouldBeDisplayed = true;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $componentWrapperAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $tableWrapperAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $tableAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $theadAttributes = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $tbodyAttributes = [];

    /**
     * Undocumented variable
     */
    protected ?Closure $thAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $thSortButtonAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $thSortIconAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $trAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $tdAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $trUrlCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $trUrlTargetCallback;

    protected string $defaultBodyTextAlign = '';

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $data
     */
    public function renderingWithTableAttributes(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with($this->getDefaultViewCustomData());
    }
}
