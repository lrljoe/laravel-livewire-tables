<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\View\Component;
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Actions\Traits\{HasActionAttributes, HasRoute, HasVisibility};
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
     *
     * @var string
     */
    protected string $view = 'livewire-tables::includes.actions.button';

    public bool $isInMenu = false;

    /**
     * Construct an Action
     *
     * @param string|null $label
     */
    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    /**
     * Make an Action
     *
     * @param string|null $label
     * @return self
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
     *
     * @return null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAction($this)
            ->withIsBootstrap($this->isBootstrap())
            ->withIsTailwind($this->isTailwind())
            ->withIsTailwind4($this->isTailwind4())
            ->withIsInMenu($this->isInMenu)
            ->withAttributes($this->getActionAttributes());

        return $view;
    }
}
