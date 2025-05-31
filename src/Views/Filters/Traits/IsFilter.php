<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\{HandlesFilterInputAttributes};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasConfig, HasLabelAttributes, HasView};

trait IsFilter
{
    use HandlesDefaultValue,
        HasLocalisations,
        HasFilterPills,
        HasFilterLabel,
        FilterConfiguration,
        FilterHelpers,
        HasConfig,
        HasCustomPosition,
        HasLabelAttributes,
        HasVisibility,
        HasView,
        HandlesFilterInputAttributes,
        HandlesClearButton;

    /**
     * Filter Name
     *
     * @var string
     */
    protected string $name;

    /**
     * Filter Key
     *
     * @var string
     */
    protected string $key;

    /**
     * Filter Callback Method
     *
     * @var mixed
     */
    protected mixed $filterCallback = null;

    /**
     * Generic Display Data for Filter
     *
     * @var array<mixed>
     */
    public array $genericDisplayData = [];
}
