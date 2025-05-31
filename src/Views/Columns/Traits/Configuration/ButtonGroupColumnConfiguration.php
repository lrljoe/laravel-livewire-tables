<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    /**
     * Undocumented function
     *
     * @param array<mixed> $buttons
     * @return self
     */
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }
}
