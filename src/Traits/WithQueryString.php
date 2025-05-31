<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\QueryStringConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\QueryStringHelpers;

trait WithQueryString
{
    use QueryStringConfiguration,
        QueryStringHelpers;

    
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $queryStringConfig = [
        'columns' => ['status' => false, 'alias' => null],
        'filters' => ['status' => true, 'alias' => null],
        'pagination' => ['status' => true, 'alias' => 'perPage'],
        'search' => ['status' => true, 'alias' => null],
        'sorts' => ['status' => true, 'alias' => null],
    ];


    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryStringWithQueryString(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }
}
