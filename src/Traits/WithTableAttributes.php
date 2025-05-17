<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\TableAttributeConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\TableAttributeHelpers;

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;
    
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

    protected ?Closure $thAttributesCallback;

    protected ?Closure $thSortButtonAttributesCallback;

    protected ?Closure $thSortIconAttributesCallback;

    protected ?Closure $trAttributesCallback;

    protected ?Closure $tdAttributesCallback;

    protected ?Closure $trUrlCallback;

    protected ?Closure $trUrlTargetCallback;

    public bool $shouldBeDisplayed = true;

    public function renderingWithTableAttributes(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with($this->getDefaultViewCustomData());
    }
}
