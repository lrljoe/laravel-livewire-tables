<?php

namespace Rappasoft\LaravelLivewireTables\Features\LoadingPlaceholder\Helpers;

trait LoadingPlaceholderHelpers
{
    public function hasDisplayLoadingPlaceholder(): bool
    {
        return $this->getDisplayLoadingPlaceholder();
    }

    public function getDisplayLoadingPlaceholder(): bool
    {
        return $this->displayLoadingPlaceholder;
    }

    public function getLoadingPlaceholderContent(): string
    {
        return $this->loadingPlaceholderContent ?? __($this->getLocalisationPath().'Loading');
    }

    public function hasLoadingPlaceholderBlade(): bool
    {
        return ! is_null($this->getLoadingPlaceHolderBlade());
    }

    public function getLoadingPlaceHolderBlade(): ?string
    {
        return $this->loadingPlaceholderBlade;
    }
}
