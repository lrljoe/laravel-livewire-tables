<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills\{HandlesPillsAsHtml,HandlesPillsCustomBlade,HandlesPillsLocale};
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterPillsAttributes;

trait HasFilterPills
{
    use HandlesPillsAsHtml,
        HandlesPillsCustomBlade,
        HandlesPillsLocale,
        HandlesFilterPillsAttributes;

    protected ?string $filterPillTitle = null;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $filterPillValues = [];

    /**
     * Undocumented function
     *
     * @param string $title
     * @return self
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @return string|null
     */
    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * Undocumented function
     *
     * @param mixed $value
     * @return array<mixed>|string|boolean|null
     */
     public function getFilterPillValue($value): array|string|bool|null
    {
        return $value;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
     public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    /**
     * Undocumented function
     *
     * @param string $value
     * @return string|null
     */
    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }
}
