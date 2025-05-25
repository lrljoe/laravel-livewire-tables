<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterLabelAttributes;

trait HasFilterLabel
{
    use HandlesFilterLabelAttributes;

    /**
     * Custom Label for the Filter
     *
     * @var string|null
     */
    protected ?string $filterCustomLabel = null;

    /**
     * Set a Custom Label for the Filter
     *
     * @param string $filterCustomLabel
     * @return self
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
}
