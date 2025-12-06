<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Defaults\HasDefaultIntegerValue;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\IsColumn;

class IntegerColumn extends Column
{
    use HasDefaultIntegerValue;

    /**
     * Undocumented function
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
        $this->setSortingPillDirections('0-9', '9-0');
    }

    /**
     * Undocumented function
     */
    public function getValue(Model $row): int
    {
        return intval(parent::getValue($row) ?? $this->getDefaultValue());
    }
}
