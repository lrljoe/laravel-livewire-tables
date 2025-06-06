<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;


trait HasOptions
{
    /**
     * Contains the list of Options for a Filter
     *
     * @var array<mixed>
     */
    public array $options = [];

    /**
     * Defines the First Option for a Filter with Options
     *
     * @var string
     */
    protected string $firstOption = '';

    /**
     * Sets the First Option for a Filter with Options
     *
     * @param string $firstOption
     * @return self
     */
    public function setFirstOption(string $firstOption): self
    {
        $this->firstOption = $firstOption;

        return $this;
    }

    /**
     * Gets the First Option for a Filter with Options
     *
     * @return string
     */
    public function getFirstOption(): string
    {
        return $this->firstOption;
    }

    /**
     * Sets the list of Options for a Filter
     *
     * @param array<mixed> $options
     * @return self
     */
    public function options(array $options = []): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Gets the list of Options for a Filter
     *
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        return $this->options ?? $this->options = (property_exists($this, 'optionsPath') ? config($this->optionsPath, []) : []);
    }

    /**
     * Gets the keys for the list of Options for a Filter
     *
     * @return array<mixed>
     */
    public function getKeys(): array
    {
        return collect($this->getOptions())
            ->keys()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value))
            ->values()
            ->toArray();
    }
}
