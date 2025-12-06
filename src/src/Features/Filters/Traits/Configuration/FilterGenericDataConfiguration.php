<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\FilterGenericData;

trait FilterGenericDataConfiguration
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function generateFilterGenericData(): array
    {
        return (new FilterGenericData($this->getTableName(), $this->getDataTableFingerprint(), $this->getFilterLayout(), $this->isTailwind(), $this->isBootstrap4(), $this->isBootstrap5(), $this->isTailwind4()))->toArray();
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $filterGenericData
     * @return void
     */
    public function setFilterGenericData(array $filterGenericData = []): void
    {
        $this->filterGenericData = $filterGenericData;
    }
}
