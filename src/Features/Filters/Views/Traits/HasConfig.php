<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait HasConfig
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $config = [];

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $config
     */
    public function config(array $config = []): self
    {
        $this->config = [...$this->config, ...$config];

        return $this;
    }

    /**
     * Get the filter configs.
     *
     * @return array<mixed>
     */
    public function getConfigs(): array
    {
        return $this->config;
    }

    /**
     * Get a single filter config.
     *
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * Undocumented function
     */
    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    /**
     * Undocumented function
     */
    public function hasConfig(string $key): bool
    {
        return array_key_exists($key, $this->getConfigs()) && $this->getConfig($key) !== null;
    }

    protected function initialiseConfig(): void {}
}
