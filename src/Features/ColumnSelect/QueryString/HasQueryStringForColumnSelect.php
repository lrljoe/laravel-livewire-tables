<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString;

trait HasQueryStringForColumnSelect
{
    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    protected function queryStringHasQueryStringForColumnSelect(): array
    {
        return ($this->getQueryStringStatusForColumnSelect() && $this->columnSelectIsEnabled()) ? ['selectedColumnsNew' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForColumnSelect()]] : [];

    }

    protected function setupQueryStringStatusForColumnSelect(): void
    {
        if (! $this->hasQueryStringStatusForColumnSelect()) {
            $this->setQueryStringForColumnSelectEnabled();
        }
    }

    public function hasQueryStringStatusForColumnSelect(): bool
    {
     ///   dd($this->hasQueryStringConfigStatus('columns'));
        return $this->hasQueryStringConfigStatus('columns');
    }

    public function getQueryStringStatusForColumnSelect(): string
    {
       // return 'test123123';
    //    dd($this->getQueryStringConfigAlias('columns'));
        return $this->getQueryStringConfigAlias('columns');
    }

    public function queryStringForColumnSelectEnabled(): bool
    {
        $this->setupQueryStringStatusForColumnSelect();

        return $this->getQueryStringStatusForColumnSelect() && $this->columnSelectIsEnabled();
    }

    public function setQueryStringStatusForColumnSelect(bool $status): self
    {
        return $this->setQueryStringConfigStatus('columns', $status);
    }

    public function setQueryStringForColumnSelectEnabled(): self
    {
        return $this->setQueryStringStatusForColumnSelect(true);
    }

    public function setQueryStringForColumnSelectDisabled(): self
    {
        return $this->setQueryStringStatusForColumnSelect(false);
    }

    public function hasQueryStringAliasForColumnSelect(): bool
    {
        return $this->hasQueryStringConfigAlias('columns');
    }

    public function getQueryStringAliasForColumnSelect(): string
    {
       // return 'test123123';
        return $this->getQueryStringConfigAlias('columns');
    }

    public function setQueryStringAliasForColumnSelect(string $alias): self
    {
        return $this->setQueryStringConfigAlias('columns', $alias);
    }
}
