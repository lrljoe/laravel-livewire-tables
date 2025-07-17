<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\TableAttributeConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\TableAttributeHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\{HasCoreStyling, HasHeaderStyling};

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;
    use HasCoreStyling, HasHeaderStyling;

    /**
     * Undocumented variable
     *
     * @var boolean
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
     *
     * @var Closure|null
     */
    protected ?Closure $thAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $thSortButtonAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $thSortIconAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $trAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $tdAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $trUrlCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $trUrlTargetCallback;

    protected string $defaultBodyTextAlign = '';

    /**
     * Undocumented function
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithTableAttributes(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with($this->getDefaultViewCustomData());
    }
}
