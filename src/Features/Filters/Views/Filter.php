<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasLabelAttributes, HasView};
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\{FilterConfiguration,FilterHelpers, HasConfig, HasCustomPosition, HandlesClearButton, HandlesDefaultValue,HasFilterPills,HasFilterLabel, HasVisibility, Styling\HandlesFilterInputAttributes};

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

    /**
     * Define the view for a Filter
     *
     * @var string
     */
    protected string $view = '';

    /**
     * Construct a Filter
     *
     * @param string $name
     * @param string|null $key
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
     * @param string $name
     * @param string|null $key
     * @return static
     */
    public static function make(string $name, ?string $key = null): Filter
    {
        return new static($name, $key);
    }
}
