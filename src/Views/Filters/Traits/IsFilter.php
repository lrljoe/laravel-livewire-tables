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

    protected string $name;

    protected string $key;

    protected mixed $filterCallback = null;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $genericDisplayData = [];
}
