<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LoadingPlaceholderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LoadingPlaceholderHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasLoadingPlaceholderStyling;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers,
        HasLoadingPlaceholderStyling;

    protected bool $displayLoadingPlaceholder = false;

    protected string $loadingPlaceholderContent = 'Loading';

    protected ?string $loadingPlaceholderBlade = null;


    public function renderingWithLoadingPlaceholder(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with([
            'loadingPlaceholderDetails' => $this->getLoadingPlaceHolderDetails()
        ]);
    }

}
