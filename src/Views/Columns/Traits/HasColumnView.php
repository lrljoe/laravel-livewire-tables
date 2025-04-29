<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;

trait HasColumnView
{
    use HasView;

    public function getColumnView(): \Illuminate\View\View
    {
        return view($this->getView());
    }

    public function getColumnViewWithDefaults(): \Illuminate\View\View
    {
        return $this->getColumnView()
        ->with($this->addColumnViewDefaults());

    }

    protected function addColumnViewDefaults(): array
    {
        return [
            'isTailwind' => $this->isTailwind(),
            'isTailwind4' => $this->isTailwind4(),
            'isBootstrap' => $this->isBootstrap(),
            'localisationPath' => $this->getLocalisationPath(),
        ];

    }

}
