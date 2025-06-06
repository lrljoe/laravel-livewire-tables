<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait HasSecondaryHeaderStyling
{
    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $secondaryHeaderTrAttributesCallback;

    /**
     * Undocumented variable
     *
     * @var Closure|null
     */
    protected ?Closure $secondaryHeaderTdAttributesCallback;

    /**
     * Undocumented function
     *
     * @param mixed $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return isset($this->secondaryHeaderTrAttributesCallback) ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * Undocumented function
     *
     * @param Column $column
     * @param mixed $rows
     * @param integer $index
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->secondaryHeaderTdAttributesCallback) ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }

    /**
     * Undocumented function
     *
     * @param Closure $callback
     * @return self
     */
    public function setSecondaryHeaderTrAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param Closure $callback
     * @return self
     */
    public function setSecondaryHeaderTdAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
