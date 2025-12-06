<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HasView
{
    protected function bootedHasView(): void
    {
        try {
            if ($this->getView() == null) {
                throw new DataTableConfigurationException('No View Defined');
            }
        } catch (\Exception $e) {
            throw new DataTableConfigurationException('No View Defined');
        }
    }

    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function setCustomView(string $customView): self
    {
        $this->setView($customView);

        return $this;
    }

    public function getViewPath(): string
    {
        return $this->view ?? '';
    }
}
