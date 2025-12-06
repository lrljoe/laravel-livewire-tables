<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait FilterMenuConfiguration
{
    public function setFilterLayout(string $type): self
    {
        if (! in_array($type, ['popover', 'slide-down'], true)) {
            throw new DataTableConfigurationException('Invalid filter layout type');
        }

       $this->filterConfiguration['filterLayout'] = $type;

        return $this;
    }

    public function setFilterLayoutPopover(): self
    {
        return $this->setFilterLayout('popover');
    }

    public function setFilterLayoutSlideDown(): self
    {
        return $this->setFilterLayout('slide-down');
    }

    public function setFilterSlideDownDefaultStatus(bool $status): self
    {
        $this->filterConfiguration['filterSlideDownDefaultVisible'] = $status;

        return $this;
    }

    public function setFilterSlideDownDefaultStatusDisabled(): self
    {
        return $this->setFilterSlideDownDefaultStatus(false);
    }

    public function setFilterSlideDownDefaultStatusEnabled(): self
    {
        return $this->setFilterSlideDownDefaultStatus(true);
    }
}
