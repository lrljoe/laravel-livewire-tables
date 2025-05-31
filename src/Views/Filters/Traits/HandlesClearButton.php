<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesClearButton
{
    /**
     * Property determining whether the Filter is reset by the Clear button or not
     *
     * @var boolean
     */
    protected bool $resetByClearButton = true;

    /**
     * Returns whether the Filter should be reset by the Clear button
     *
     * @return boolean
     */
    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    /**
     * Sets the Filter to not be reset by the Clear button
     *
     * @return self
     */
    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }
}
