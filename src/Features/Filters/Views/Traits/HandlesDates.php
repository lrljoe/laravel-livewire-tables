<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Pills\HandlesPillsLocale;

trait HandlesDates
{
    use HandlesPillsLocale;

    protected string $inputDateFormat;

    protected string $outputDateFormat;

    protected Carbon $carbonInstance;

    protected function createCarbon(): void
    {
        $this->carbonInstance = new Carbon;
        $this->carbonInstance->setLocale($this->getPillsLocale());

    }

    protected function createCarbonDate(string $value): Carbon|bool
    {
        $this->createCarbon();
        $fromFormat = false;
        try {
            $fromFormat = $this->carbonInstance->createFromFormat($this->inputDateFormat, $value);
        } catch (\Exception $e) {
            return false;
        }

        return $fromFormat;
    }

    protected function setInputDateFormat(string $inputDateFormat): self
    {
        $this->inputDateFormat = $inputDateFormat;

        return $this;
    }

    protected function setOutputDateFormat(string $outputDateFormat): self
    {
        $this->outputDateFormat = $outputDateFormat;

        return $this;
    }

    protected function outputTranslatedDate(?Carbon $carbon): string
    {
        if ($carbon instanceof Carbon) {
            return $carbon->translatedFormat($this->outputDateFormat);
        }

        return '';
    }

    /**
     * Retrieve Date Filter Value as Formatted Date For the Filter Pill
     *
     * @param string $value
     * @return string|null
     */
    protected function getFilterPillValueAsFormattedDate(string $value): ?string
    {
        $carbonDate = $this->createCarbonDate($value);
        if ($carbonDate instanceof Carbon) {
            return $this->outputTranslatedDate($carbonDate);
        }
        return null;

    }
    
}
