<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait QueryHelpers
{
    /**
     * Undocumented function
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function getBuilder(): Builder
    {
        if (! isset($this->builder)) {
            $this->setBuilder($this->builder());
        }

        return $this->builder;
    }

    public function hasPrimaryKey(): bool
    {
        return isset($this->primaryKey);
    }

    /**
     * @return mixed
     */
    #[Computed]
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @return array<mixed>
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @return array<mixed>
     */
    public function getAdditionalSelects(): array
    {
        return $this->additionalSelects;
    }

    public function hasExtraWiths(): bool
    {
        return ! empty($this->extraWiths);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getExtraWiths(): array
    {
        return $this->extraWiths;
    }

    /**
     * Undocumented function
     */
    public function hasExtraWithCounts(): bool
    {
        return ! empty($this->extraWithCounts);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getExtraWithCounts(): array
    {
        return $this->extraWithCounts;
    }

    /**
     * Undocumented function
     */
    public function hasExtraWithSums(): bool
    {
        return ! empty($this->extraWithSums);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getExtraWithSums(): array
    {
        return $this->extraWithSums;
    }

    /**
     * Undocumented function
     */
    public function hasExtraWithAvgs(): bool
    {
        return ! empty($this->extraWithAvgs);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getExtraWithAvgs(): array
    {
        return $this->extraWithAvgs;
    }

    /**
     * Undocumented function
     */
    public function getEagerLoadAllRelationsStatus(): bool
    {
        return $this->eagerLoadAllRelationsStatus;
    }

    /**
     * Undocumented function
     */
    public function eagerLoadAllRelationsIsEnabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === true;
    }

    /**
     * Undocumented function
     */
    public function eagerLoadAllRelationsIsDisabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === false;
    }

    protected function includePrimaryKeyInQuery(): void
    {
        $builder = $this->getBuilder();

        $pkField = $builder->getModel()->getTable().'.'.$this->getPrimaryKey().' as '.$this->getPrimaryKey();

        if (! in_array($pkField, $builder->getQuery()->columns ?? [])) {
            $this->setBuilder($builder->addSelect($pkField));
        }
    }
}
