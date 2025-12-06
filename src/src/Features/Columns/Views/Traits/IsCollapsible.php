<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait IsCollapsible
{
    /**
     * Collapse On Mobile Setting
     */
    protected bool $collapseOnMobile = false;

    /**
     * Collapse On Tablet Setting
     */
    protected bool $collapseOnTablet = false;

    /**
     * Collapse Always Setting
     */
    protected bool $collapseAlways = false;

    /**
     * Collapse Sometimes Setting
     */
    protected bool $collapseSometimes = false;

    /**
     * Column Should Collapse On Mobile
     */
    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;
        $this->collapseSometimes = true;

        return $this;
    }

    /**
     * Column Should Collapse On Tablet
     */
    public function collapseOnTablet(): self
    {
        $this->collapseOnTablet = true;
        $this->collapseSometimes = true;

        return $this;
    }

    /**
     * Column Should Collapse Always
     */
    public function collapseAlways(): self
    {
        $this->collapseAlways = true;
        $this->collapseSometimes = true;

        return $this;
    }

    public function shouldCollapseOnMobile(): bool
    {
        return $this->collapseOnMobile;
    }

    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    public function shouldCollapseAlways(): bool
    {
        return $this->collapseAlways;
    }

    public function shouldCollapseSometimes(): bool
    {
        return $this->collapseSometimes;
    }

    public function shouldNeverCollapse(): bool
    {
        return $this->collapseSometimes === false;
    }

    public function shouldCollapseNever(): bool
    {
        return ($this->shouldCollapseOnMobile() === false) && ($this->shouldCollapseOnTablet() === false) && ($this->shouldCollapseAlways() === false);
    }
}
