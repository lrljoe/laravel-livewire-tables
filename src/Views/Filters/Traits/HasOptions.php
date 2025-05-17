<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;


trait HasOptions
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $options = [];

    protected string $firstOption = '';

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return string
     */
    public function getFirstOption(): string
    {
        return $this->firstOption;
    }

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getOptions(): array
    {
        return $this->options ?? $this->options = (property_exists($this, 'optionsPath') ? config($this->optionsPath, []) : []);
    }

    /**
     * Undocumented function
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
