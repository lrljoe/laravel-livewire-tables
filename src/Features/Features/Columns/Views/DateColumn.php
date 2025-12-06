<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\DateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\{HasInputOutputFormat, IsColumn};
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\DateColumnHelpers;

class DateColumn extends Column
{
    use IsColumn,
        HasInputOutputFormat,
        DateColumnConfiguration,
        DateColumnHelpers { DateColumnHelpers::getValue insteadof IsColumn; }

    /**
     * Undocumented variable
     */
    public string $inputFormat = 'Y-m-d';

    /**
     * Undocumented variable
     */
    public string $outputFormat = 'Y-m-d';

    /**
     * Undocumented variable
     */
    public string $emptyValue = '';

    /**
     * Undocumented variable
     */
    protected string $view = 'livewire-tables::includes.columns.date';

    /**
     * Undocumented function
     */
    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        try {
            $dateTime = $this->getValue($row);
            if ($dateTime != '' && $dateTime != null) {
                if ($dateTime instanceof DateTime) {
                    return $dateTime->format($this->getOutputFormat());
                } elseif ($dateTime instanceof DateTimeImmutable) {
                    return Carbon::createFromImmutable($dateTime)->format($this->getOutputFormat());
                } else {
                    // Check if format matches what is expected and return Carbon instance if so, otherwise emptyValue
                    return Carbon::canBeCreatedFromFormat($dateTime, $this->getInputFormat()) ? Carbon::createFromFormat($this->getInputFormat(), $dateTime)->format($this->getOutputFormat()) : $this->getEmptyValue();
                }
            }
        } catch (\Exception $exception) {
            return $this->getEmptyValue();
        }

        return $this->getEmptyValue();
    }
}
