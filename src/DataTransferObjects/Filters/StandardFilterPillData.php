<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

class StandardFilterPillData
{
    /**
     * Undocumented function
     *
     * @param string $filterPillTitle
     * @param string $filterSelectName
     * @param string $filterPillValue
     * @param boolean $renderPillsAsHtml
     */
    public function __construct(protected string $filterPillTitle, protected string $filterSelectName, protected string $filterPillValue, protected bool $renderPillsAsHtml) {}

    /**
     * Undocumented function
     *
     * @param string $filterPillTitle
     * @param string $filterSelectName
     * @param string $filterPillValue
     * @param boolean $renderPillsAsHtml
     * @return StandardFilterPillData
     */
    public static function make(string $filterPillTitle, string $filterSelectName, string $filterPillValue, bool $renderPillsAsHtml = false): StandardFilterPillData
    {
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $renderPillsAsHtml);
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getSelectName(): string
    {
        return $this->filterSelectName;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getPillValue(): string
    {
        return $this->filterPillValue;
    }

    /**
     * Undocumented function
     *
     * @return boolean
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
