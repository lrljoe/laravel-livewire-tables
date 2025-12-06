<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

use Illuminate\Support\Facades\View;

trait HasComponentView
{
    protected string $componentView;
    
    protected ?string $customComponentView;

    public function component(string $component): self
    {
        if (View::exists('components.'.$component)) {
            $this->componentView = 'components.'.$component;
        } elseif (View::exists($component)) {
            $this->componentView = $component;
        }

        return $this;
    }

    public function customComponent(string $customComponentView): self
    {
        $this->customComponentView = $customComponentView;

        return $this;
    }

    public function getComponentView(): string
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }

    public function hasCustomComponent(): bool
    {
        return isset($this->customComponentView);
    }

    public function getCustomComponent(): string
    {
        return $this->customComponentView;
    }
}
