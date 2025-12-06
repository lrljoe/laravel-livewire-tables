<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration;

use Closure;

trait ColorColumnConfiguration
{
    public function color(Closure $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }
}
