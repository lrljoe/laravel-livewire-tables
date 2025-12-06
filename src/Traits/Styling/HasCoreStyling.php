<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

trait HasCoreStyling
{
    /**
     * Core Transition Attributes Used For Menus
     *
     * @var array<string,string>
     */
    protected array $coreTransitionAttributes = [
        'x-transition:enter' => 'transition ease-out duration-100',
        'x-transition:enter-start' => 'transform opacity-0 scale-95',
        'x-transition:enter-end' => 'transform opacity-100 scale-100',
        'x-transition:leave' => 'transition ease-in duration-75',
        'x-transition:leave-start' => 'transform opacity-100 scale-100',
        'x-transition:leave-end' => 'transform opacity-0 scale-95',
    ];

    /**
     * Core Attributes Used For Popover Menus in Tailwind
     *
     * @var array<string,string>
     */
    protected array $coreMenuAttributes = [
        'role' => 'menu',
        'aria-orientation' => 'vertical',
        'x-cloak' => '',
        'x-show' => 'open',
        'x-on:click.away' => 'if (!childElementOpen) { open = false }',
        '@keydown.window.escape' => 'if (!childElementOpen) { open = false }',
    ];

    /**
     * Get Core Attributes Used For Popover Menus in Tailwind
     *
     * @return array<string,string>
     */
    public function getCoreMenuAttributes(): array
    {
        if ($this->isTailwind() || $this->isTailwind4()) {
            return $this->coreMenuAttributes;
        }

        return ['role' => 'menu', 'aria-orientation' => 'vertical'];
    }

    /**
     * Set Core Attributes Used For Popover Menus in Tailwind
     *
     * @param  array<string,string>  $attributes
     */
    protected function setCoreMenuAttributes(array $attributes): self
    {
        $this->coreMenuAttributes = $attributes;

        return $this;
    }

    /**
     * Get Core Transition Attributes Used For Menus in Tailwind
     *
     * @return array<string,string>
     */
    public function getCoreTransitionAttributes(): array
    {
        return $this->coreTransitionAttributes;
    }

    /**
     * Set Core Transition Attributes Used For Menus in Tailwind
     *
     * @param  array<string,string>  $attributes
     */
    protected function setCoreTransitionAttributes(array $attributes): self
    {
        $this->coreTransitionAttributes = $attributes;

        return $this;
    }
}
