<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait HasHeaderStyling
{
    protected ?Closure $headerTrAttributesCallback;

    protected ?Closure $headerTdAttributesCallback;

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getHeaderTrAttributes($rows): array
    {
        return isset($this->headerTrAttributesCallback) ? call_user_func($this->headerTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->headerTdAttributesCallback) ? call_user_func($this->headerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }

    public function setHeaderTrAttributes(Closure $callback): self
    {
        $this->headerTrAttributesCallback = $callback;

        return $this;
    }

    public function setHeaderTdAttributes(Closure $callback): self
    {
        $this->headerTdAttributesCallback = $callback;

        return $this;
    }
}
