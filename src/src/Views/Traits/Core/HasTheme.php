<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Livewire\Attributes\{Computed, Locked};

trait HasTheme
{
    /**
     * Undocumented variable
     */
    #[Locked]
    public ?string $theme;

    /**
     * Undocumented variable
     */
    #[Locked]
    public string $paginationTheme = 'tailwind';

    /**
     * Undocumented function
     */
    public function getTheme(): string
    {
        return $this->theme ?? ($this->theme = config('livewire-tables.theme', 'tailwind'));
    }

    /**
     * Undocumented function
     */
    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        if (($theme === 'bootstrap-4' || $theme === 'bootstrap-5')) {
            $this->setPaginationTheme('bootstrap');
        } else {
            $this->setPaginationTheme('tailwind');
        }

        return $this;
    }

    /**
     * Undocumented function
     */
    public function getPaginationTheme(): string
    {
        return $this->paginationTheme;
    }

    /**
     * Undocumented function
     */
    public function setPaginationTheme(string $theme): self
    {
        $this->paginationTheme = $theme;

        return $this;
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function isTailwind(): bool
    {
        return $this->getTheme() === 'tailwind' || (! $this->isBootstrap() && ! $this->isTailwind4());
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function isBootstrap(): bool
    {
        return $this->isBootstrap4() || $this->isBootstrap5();
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function isBootstrap4(): bool
    {
        return $this->getTheme() === 'bootstrap-4';
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function isBootstrap5(): bool
    {
        return $this->getTheme() === 'bootstrap-5';
    }

    /**
     * Undocumented function
     */
    #[Computed]
    public function isTailwind4(): bool
    {
        return $this->getTheme() === 'tailwind-4';
    }
}
