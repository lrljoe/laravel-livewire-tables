<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Views;

use Illuminate\View\Component;
use Rappasoft\LaravelLivewireTables\Features\BulkActions\Views\Traits\{HandlesBulkActionAttributes,HandlesConfirmationMessage};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasIcon;

class BulkAction
{
    use HandlesBulkActionAttributes;
    use HandlesConfirmationMessage;
    use HasIcon;

    public function __construct(public string $action, public string $title)
    {
        $this->iconRight = false;
    }

    /**
     * Make a BulkAction
     *
     * @return static
     */
    public static function make(string $action, string $title): BulkAction
    {
        return new static($action, $title);
    }

    /**
     * Returns the defined action
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Undocumented function
     */
    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::includes.bulkactions.item')
            ->withAttributes($this->getButtonAttributesBag())
            ->withAction($this->action)
            ->withTitle($this->title)
            ->withIcon($this->hasIcon() ? $this->getIcon() : '')
            ->withIconRight($this->getIconRight())
            ->withIconAttributes($this->getIconAttributes());

    }
}
