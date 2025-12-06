<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Pills\{HandlesPillsAsHtml,HandlesPillsCustomBlade,HandlesPillsLocale, HandlesPillsTitle};
use Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Styling\HandlesFilterPillsAttributes;

trait HasFilterPills
{
    use HandlesPillsAsHtml,
        HandlesPillsCustomBlade,
        HandlesPillsLocale,
        HandlesFilterPillsAttributes,
        HandlesPillsTitle;

    /**
     * Defined Filter Pill Values
     *
     * @var array<mixed>
     */
    protected array $filterPillValues = [];

    /**
     * Sets the Filter Pills Values for this Filter
     *
     * @param  array<mixed>  $values
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    /**
     * Retrieves the Filter Pills Values for this Filter
     *
     * @param  mixed  $value
     * @return array<mixed>|string|bool|null
     */
    public function getFilterPillValue($value): array|string|bool|null
    {
        return $value;
    }

    /**
     * Retrieves Custom Filter Pills Values for this Filter
     *
     * @return array<mixed>
     */
    public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    /**
     * Retrieves Specific Custom Filter Pills Value for this Filter
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }
}
