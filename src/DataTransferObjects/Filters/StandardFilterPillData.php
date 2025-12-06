<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

class StandardFilterPillData
{
    /**
     * Undocumented function
     */
    public function __construct(protected string $filterPillTitle, protected string $filterSelectName, protected string $filterPillValue, protected bool $renderPillsAsHtml) {}

    /**
     * Undocumented function
     */
    public static function make(string $filterPillTitle, string $filterSelectName, string $filterPillValue, bool $renderPillsAsHtml = false): StandardFilterPillData
    {
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $renderPillsAsHtml);
    }

    /**
     * Undocumented function
     */
    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    /**
     * Undocumented function
     */
    public function getSelectName(): string
    {
        return $this->filterSelectName;
    }

    /**
     * Undocumented function
     */
    public function getPillValue(): string
    {
        return $this->filterPillValue;
    }

    /**
     * Undocumented function
     */
    public function shouldUsePillsAsHtml(): bool
    {
        return $this->renderPillsAsHtml;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'filterPillTitle' => $this->getTitle(),
            'filterSelectName' => $this->getSelectName(),
            'filterPillValue' => $this->getPillValue(),
            'renderPillsAsHtml' => $this->shouldUsePillsAsHtml(),
        ];
    }
}
