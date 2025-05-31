<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills;

trait HandlesPillsTitle
{
    /**
     * Defined Filter Pill Title
     *
     * @var string|null
     */
    protected ?string $filterPillTitle = null;

    /**
     * Sets the Filter Pills title for this Filter
     *
     * @param string $title
     * @return self
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

        /**
     * Retrieves Custom Filter Pills Titles for this Filter
     *
     * @return string|null
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * Retrieves Filter Pills Titles for this Filter
     *
     * @return string
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }
}