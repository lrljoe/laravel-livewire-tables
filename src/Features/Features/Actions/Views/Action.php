<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Views;

use Illuminate\View\Component;
use Rappasoft\LaravelLivewireTables\Features\Actions\Views\Traits\{HasActionAttributes, HasRoute, HasVisibility};
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasIcon, HasLabel, HasLabelAttributes, HasTheme, HasView, HasWireActions};

class Action extends Component
{
    use HasLocalisations;
    use HasActionAttributes;
    use HasIcon;
    use HasLabel;
    use HasLabelAttributes;
    use HasRoute;
    use HasTheme;
    use HasView;
    use HasVisibility;
    use HasWireActions;

    /**
     * The view for the Action
     */
    protected string $view = 'livewire-tables::includes.actions.button';

    /**
     * Undocumented variable
     */
    public bool $isInMenu = false;

    /**
     * Construct an Action
     */
    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    /**
     * Make an Action
     */
    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function setInMenu(bool $status): self
    {
        $this->isInMenu = true;

        return $this;
    }

    /**
     * Render method for Action
     */
    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAction($this)
            ->withIsInMenu($this->isInMenu)
            ->withAttributes($this->getActionAttributesBag());

        return $view;
    }
}
