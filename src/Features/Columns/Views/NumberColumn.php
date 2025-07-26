<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\{IsColumn};
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults\{HasDefaultFloatValue};

class NumberColumn extends Column
{
    use HasDefaultFloatValue;

    /**
     * Undocumented function
     *
     * @param string $title
     * @param string|null $from
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
        $this->setSortingPillDirections('0-9','9-0');
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @return string
     */
    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }

}
