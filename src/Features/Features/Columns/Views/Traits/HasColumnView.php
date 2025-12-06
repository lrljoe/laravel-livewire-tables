<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;

trait HasColumnView
{
    use HasView;

    /**
     * Undocumented function
     */
    public function getColumnView(): \Illuminate\View\View
    {
        return view($this->getView());
    }

    /**
     * Undocumented function
     */
    public function getColumnViewWithDefaults(): \Illuminate\View\View
    {
        return $this->getColumnView()
            ->with($this->addColumnViewDefaults());

    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
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
