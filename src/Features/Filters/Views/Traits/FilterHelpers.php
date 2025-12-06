<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Filter;

trait FilterHelpers
{
    /**
     * Get the filter name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the filter key
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Get the filter keys.
     *
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return [];
    }

    /**
     * Configures the Filter function
     */
    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * Determines if a Filter function has been set
     */
    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    /**
     * Retrieves the Filter function
     */
    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    /**
     * Generates a unique wire:key
     */
    public function generateWireKey(string $tableName, string $filterType, string $extraData = ''): string
    {
        return $tableName.'-filter-'.$filterType.'-'.$this->getKey().($extraData != '' ? '-'.$extraData : '').($this->hasCustomPosition() ? '-'.$this->getCustomPosition() : '');
    }

    /**
     * Retrieves the Generic Filter Data
     *
     * @return array<mixed>
     */
    public function getGenericDisplayData(): array
    {
        return $this->genericDisplayData;
    }

    /**
     * Retrieves the Generic Filter Data, with the Filter instance
     *
     * @return array<mixed>
     */
    public function getFilterDisplayData(): array
    {
        return array_merge($this->getGenericDisplayData(), ['filter' => $this]);
    }

    /**
     * Renders the Filter
     */
    public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view($this->getViewPath())
            ->with($this->getFilterDisplayData())
            ->with([
                'filterInputAttributes' => $this->getInputAttributesBag(),
                'filterLabelAttributes' => $this->getFilterLabelAttributes(),
                'customLabelAttributes' => $this->getLabelAttributes(),
            ]);
    }
}
