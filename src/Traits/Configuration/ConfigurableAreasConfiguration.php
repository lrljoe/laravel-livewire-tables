<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ConfigurableAreasConfiguration
{
    /**
     * Set all configurable areas to this array of configuration data
     *
     * @param array<mixed> $areas
     * @return self
     */
     public function setConfigurableAreas(array $areas): self
    {
        $this->configurableAreas = $areas;

        return $this;
    }

    /**
     * Configure a specific Configurable Area
     *
     * @param string $configurableArea
     * @param array<mixed> $config
     * @return self
     */
    public function setConfigurableArea(string $configurableArea, array $config): self
    {
        if (array_key_exists($configurableArea, $this->configurableAreas)) {
            $this->configurableAreas[$configurableArea] = $config;
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingStatus(bool $status): self
    {
        $this->hideConfigurableAreasWhenReorderingStatus = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingEnabled(): self
    {
        return $this->setHideConfigurableAreasWhenReorderingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingDisabled(): self
    {
        return $this->setHideConfigurableAreasWhenReorderingStatus(false);
    }
}
