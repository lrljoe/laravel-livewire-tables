<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Styling\HandlesFilterLabelAttributes;

trait HasFilterLabel
{
    use HandlesFilterLabelAttributes;

    /**
     * Custom Label for the Filter
     */
    protected ?string $filterCustomLabel = null;

    protected bool $showLabelInHeader = true;

    protected bool $showLabelInFooter = true;

    /**
     * Set a Custom Label for the Filter
     */
    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->filterCustomLabel = $filterCustomLabel;

        return $this;
    }

    /**
     * Returns whether the Filter has a Custom Label blade
     */
    public function hasCustomFilterLabel(): bool
    {
        return ! is_null($this->filterCustomLabel);
    }

    /**
     * Returns the path to the Filter's Custom Label blade
     */
    public function getCustomFilterLabel(): string
    {
        return $this->filterCustomLabel ?? '';
    }

    /**
     * Show Filter Label in Secondary Header
     */
    public function setShowLabelInHeader(bool $status): self
    {
        $this->showLabelInHeader = $status;

        return $this;
    }

    /**
     * Show Filter Label in Footer
     */
    public function setShowLabelInFooter(bool $status): self
    {
        $this->showLabelInFooter = $status;

        return $this;
    }

    public function getShowLabelInHeader(): bool
    {
        return $this->showLabelInHeader ?? true;
    }

    public function getShowLabelInFooter(): bool
    {
        return $this->showLabelInFooter ?? true;
    }
}
