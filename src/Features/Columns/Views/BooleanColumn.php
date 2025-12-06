<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\BooleanColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\BooleanColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasCallback,HasConfirmation};

class BooleanColumn extends Column
{
    use BooleanColumnConfiguration,
        BooleanColumnHelpers,
        HasConfirmation,
        HasCallback;

    /**
     * Undocumented variable
     */
    protected string $type = 'icons';

    /**
     * Undocumented variable
     */
    public bool $successValue = true;

    /**
     * Undocumented variable
     */
    protected string $view = 'livewire-tables::includes.columns.boolean';

    /**
     * Undocumented variable
     */
    protected bool $isToggleable = false;

    /**
     * Undocumented variable
     */
    protected ?string $toggleMethod;

    /**
     * Undocumented function
     */
    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not specify a boolean column as a label.');
        }

        $value = $this->getValue($row);
        $status = $this->hasCallback() ? call_user_func($this->getCallback(), $value, $row) : (bool) $value === true;

        return $this->getColumnViewWithDefaults()
            ->withRowPrimaryKey($row->{$row->getKeyName()})
            ->withIsToggleable($this->getIsToggleable())
            ->withToggleMethod($this->getIsToggleable() ? $this->getToggleMethod() : '')
            ->withHasConfirmMessage($this->hasConfirmMessage())
            ->withConfirmMessage($this->hasConfirmMessage() ? $this->getConfirmMessage() : '')
            ->withSuccessValue($this->getSuccessValue())
            ->withIsSuccessful($this->checkSuccess($status))
            ->withValue($value)
            ->withType($this->getType())
            ->withStatus($status);
    }
}
