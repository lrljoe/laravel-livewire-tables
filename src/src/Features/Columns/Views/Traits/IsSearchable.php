<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait IsSearchable
{
    protected bool $searchable = false;

    protected bool $wildcardSearch = true;

    protected mixed $searchCallback = null;

    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }

    public function isSearchable(): bool
    {
        return $this->hasField() && $this->searchable === true;
    }

    public function isWildcardSearchable(): bool
    {
        return $this->isSearchable() && $this->wildcardSearch === true;
    }

    public function hasSearchCallback(): bool
    {
        return $this->searchCallback !== null;
    }

    public function enableWildcardSearch(): self
    {
        $this->wildcardSearch = true;

        return $this;
    }

    public function disableWildcardSearch(): self
    {
        $this->wildcardSearch = false;

        return $this;
    }

    public function searchable(?callable $callback = null): self
    {
        $this->searchable = true;

        if (! is_null($callback)) {
            $this->disableWildcardSearch();
        }

        $this->searchCallback = $callback;

        return $this;
    }
}
