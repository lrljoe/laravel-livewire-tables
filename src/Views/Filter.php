<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\IsFilter;

abstract class Filter
{
    use IsFilter;

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
        $this->config([]);
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
