<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait HandlesClearButton
{
    /**
     * Property determining whether the Filter is reset by the Clear button or not
     */
    protected bool $resetByClearButton = true;

    /**
     * Returns whether the Filter should be reset by the Clear button
     */
    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    /**
     * Sets the Filter to not be reset by the Clear button
     */
    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }
}
