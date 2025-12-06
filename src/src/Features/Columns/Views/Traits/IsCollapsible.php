<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait IsCollapsible
{
    /**
     * Collapse On Mobile Setting
     *
     * @var boolean
     */
    protected bool $collapseOnMobile = false;

    /**
     * Collapse On Tablet Setting
     *
     * @var boolean
     */
    protected bool $collapseOnTablet = false;

    /**
     * Collapse Always Setting
     *
     * @var boolean
     */
    protected bool $collapseAlways = false;

    /**
     * Collapse Sometimes Setting
     *
     * @var boolean
     */
    protected bool $collapseSometimes = false;

    /**
     * Column Should Collapse On Mobile
     *
     * @return self
     */
    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;
        $this->collapseSometimes = true;

        return $this;
    }

    /**
     * Column Should Collapse On Tablet
     *
     * @return self
     */
    public function collapseOnTablet(): self
    {
        $this->collapseOnTablet = true;
        $this->collapseSometimes = true;

        return $this;
    }

    /**
     * Column Should Collapse Always
     *
     * @return self
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
