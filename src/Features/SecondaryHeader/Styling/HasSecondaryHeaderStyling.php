<?php

namespace Rappasoft\LaravelLivewireTables\Features\SecondaryHeader\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HasSecondaryHeaderStyling
{
    /**
     * Undocumented variable
     */
    protected ?Closure $secondaryHeaderTrAttributesCallback;

    /**
     * Undocumented variable
     */
    protected ?Closure $secondaryHeaderTdAttributesCallback;

    /**
     * Undocumented function
     *
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return isset($this->secondaryHeaderTrAttributesCallback) ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * Undocumented function
     *
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->secondaryHeaderTdAttributesCallback) ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }

    /**
     * Undocumented function
     */
    public function setSecondaryHeaderTrAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setSecondaryHeaderTdAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
