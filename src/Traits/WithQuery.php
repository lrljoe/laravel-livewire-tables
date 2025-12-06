<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\QueryConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\QueryHelpers;

trait WithQuery
{
    use QueryConfiguration,
        QueryHelpers;

    /**
     * Undocumented variable
     *
     * @var Builder<\Illuminate\Database\Eloquent\Model>
     */
    protected Builder $builder;

    /**
     * Undocumented variable
     */
    protected ?string $primaryKey;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $relationships = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $additionalSelects = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $extraWiths = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $extraWithCounts = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $extraWithSums = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $extraWithAvgs = [];

    /**
     * Undocumented variable
     */
    protected bool $eagerLoadAllRelationsStatus = false;
}
