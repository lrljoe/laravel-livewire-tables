<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills\{HandlesPillsAsHtml,HandlesPillsCustomBlade,HandlesPillsLocale, HandlesPillsTitle};
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterPillsAttributes;

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
     * @param array<mixed> $values
     * @return self
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    /**
     * Retrieves the Filter Pills Values for this Filter
     *
     * @param mixed $value
     * @return array<mixed>|string|boolean|null
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
     *
     * @param string $value
     * @return string|null
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }
}
