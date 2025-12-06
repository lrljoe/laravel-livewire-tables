<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{FilterConfiguration, FilterHelpers, HandlesClearButton, HandlesDefaultValue, HasConfig, HasCustomPosition, HasFilterLabel, HasFilterPills, HasVisibility, Styling\HandlesFilterInputAttributes};
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasLabelAttributes, HasView};

abstract class Filter
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
     */
    protected string $name;

    /**
     * Filter Key
     */
    protected string $key;

    /**
     * Filter Callback Method
     */
    protected mixed $filterCallback = null;

    /**
     * Generic Display Data for Filter
     *
     * @var array<mixed>
     */
    public array $genericDisplayData = [];

    /**
     * Define the view for a Filter
     */
    protected string $view = '';

    /**
     * Construct a Filter
     */
    public function __construct(string $name, ?string $key = null)
    {
        $this->name = $name;

        if ($key) {
            $this->key = $key;
        } else {
            $this->key = Str::snake($name);
        }
        $this->initialiseConfig();
    }

    /**
     * Define a Filter
     *
     * @return static
     */
    public static function make(string $name, ?string $key = null): Filter
    {
        return new static($name, $key);
    }
}
