<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Pills;

trait HandlesPillsTitle
{
    /**
     * Defined Filter Pill Title
     */
    protected ?string $filterPillTitle = null;

    /**
     * Sets the Filter Pills title for this Filter
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * Retrieves Custom Filter Pills Titles for this Filter
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * Retrieves Filter Pills Titles for this Filter
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }
}
