<?php

namespace Rappasoft\LaravelLivewireTables\Features\ConfigurableAreas;

trait WithConfigurableAreas
{

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected bool $hideConfigurableAreasWhenReorderingStatus = true;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $configurableAreas = [
        'before-tools' => null,
        'toolbar-left-start' => null,
        'toolbar-left-end' => null,
        'toolbar-right-start' => null,
        'toolbar-right-end' => null,
        'before-toolbar' => null,
        'after-toolbar' => null,
        'after-tools' => null,
        'before-pagination' => null,
        'after-pagination' => null,
    ];

    /**
     * @return array<mixed>
     */
    public function getConfigurableAreas(): array
    {
        return $this->configurableAreas;
    }

    public function hasConfigurableAreaFor(string $area): bool
    {
        if ($this->hideConfigurableAreasWhenReorderingIsEnabled() && $this->reorderIsEnabled() && $this->currentlyReorderingIsEnabled()) {
            return false;
        }

        return isset($this->configurableAreas[$area]) && $this->getConfigurableAreaFor($area) !== null;
    }

    public function getConfigurableAreaFor(string $area): ?string
    {
        $area = array_key_exists($area, $this->configurableAreas) ? $this->configurableAreas[$area] : null;

        if (is_array($area)) {
            return $area[0];
        }

        return $area;
    }

    /**
     * Undocumented function
     *
     * @param string $area
     * @return array<mixed>
     */
    public function getParametersForConfigurableArea(string $area): array
    {
        $area = array_key_exists($area, $this->configurableAreas) ? $this->configurableAreas[$area] : null;

        if (is_array($area) && isset($area[1]) && is_array($area[1])) {
            return $area[1];
        }

        return [];
    }

    public function getHideConfigurableAreasWhenReorderingStatus(): bool
    {
        return $this->hideConfigurableAreasWhenReorderingStatus;
    }

    public function hideConfigurableAreasWhenReorderingIsEnabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === true;
    }

    public function hideConfigurableAreasWhenReorderingIsDisabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === false;
    }

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
     * @param string|array<mixed> $config
     * @return self
     */
    public function setConfigurableArea(string $configurableArea, string|array $config = []): self
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
