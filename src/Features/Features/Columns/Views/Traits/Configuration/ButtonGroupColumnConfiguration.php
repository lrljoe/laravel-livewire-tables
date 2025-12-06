<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    /**
     * Undocumented function
     *
     * @param  array<mixed>  $buttons
     */
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }
}
