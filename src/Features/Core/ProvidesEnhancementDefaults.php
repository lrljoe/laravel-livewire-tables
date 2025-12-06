<?php

namespace Rappasoft\LaravelLivewireTables\Features\Core;

trait ProvidesEnhancementDefaults
{
    protected bool $enhancedDefaults = false;

    protected function setEnhancedDefaults(bool $status): self
    {
        $this->enhancedDefaults = $status;
        return $this;
    }

    protected function setEnhancedDefaultsEnabled(): self
    {
        return $this->setEnhancedDefaults(true)
            ->setupEnhancedDefaults();
    }

    protected function setEnhancedDefaultsDisabled(): self
    {
        return $this->setEnhancedDefaults(false);
    }

    protected function getEnhancedDefaultsStatus(): bool
    {
        return $this->enhancedDefaults ?? false;
    }

    protected function setupEnhancedDefaults(): self
    {
        if($this->getEnhancedDefaultsStatus())
        {
            $this->setModernColumnSelectEnabled()
                ->setActionsInToolbarEnabled()
                ->setExcludeDeselectedColumnsFromQueryEnabled();
        }
        return $this;
    }

}