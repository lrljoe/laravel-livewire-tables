<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HasConfig
{
    /**
     * Undocumented function
     *
     * @param array<mixed> $config
     * @return self
     */
    public function config(array $config = []): self
    {
        $this->config = [...config($this->configPath), ...$config];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getConfigs(): array
    {
        return ! empty($this->config) ? $this->config : $this->config = config($this->configPath);
    }
}
