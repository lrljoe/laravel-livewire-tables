<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

use Illuminate\View\ComponentAttributeBag;

class FilterPillData
{
    public string $separatedValues = '';

    /**
     * Undocumented function
     *
     * @param string $filterKey
     * @param string $filterPillTitle
     * @param string|array<mixed>|null $filterPillValue
     * @param string $separator
     * @param boolean $isAnExternalLivewireFilter
     * @param boolean $hasCustomPillBlade
     * @param string|null $customPillBlade
     * @param array<mixed> $filterPillsItemAttributes
     * @param boolean $renderPillsAsHtml
     * @param boolean $watchForEvents
     * @param array<mixed> $customResetButtonAttributes
     * @param boolean $renderPillsTitleAsHtml
     */
    public function __construct(
        protected string $filterKey,
        protected string $filterPillTitle,
        protected string|array|null $filterPillValue,
        protected string $separator,
        public bool $isAnExternalLivewireFilter,
        public bool $hasCustomPillBlade,
        protected ?string $customPillBlade,
        protected array $filterPillsItemAttributes,
        protected bool $renderPillsAsHtml,
        protected bool $watchForEvents,
        protected array $customResetButtonAttributes,
        protected bool $renderPillsTitleAsHtml) {}

   /**
     * Undocumented function
     *
     * @param string $filterKey
     * @param string $filterPillTitle
     * @param string|array<mixed>|null $filterPillValue
     * @param string $separator
     * @param boolean $isAnExternalLivewireFilter
     * @param boolean $hasCustomPillBlade
     * @param string|null $customPillBlade
     * @param array<mixed> $filterPillsItemAttributes
     * @param boolean $renderPillsAsHtml
     * @param boolean $watchForEvents
     * @param array<mixed> $customResetButtonAttributes
     * @param boolean $renderPillsTitleAsHtml
     */
    public static function make(
        string $filterKey, 
        string $filterPillTitle, 
        string|array|null $filterPillValue, 
        string $separator = ', ', 
        bool $isAnExternalLivewireFilter = false, 
        bool $hasCustomPillBlade = false, 
        ?string $customPillBlade = null, 
        array $filterPillsItemAttributes = [], 
        bool $renderPillsAsHtml = false, 
        bool $watchForEvents = false, 
        array $customResetButtonAttributes = [], 
        bool $renderPillsTitleAsHtml = false
    ): FilterPillData
    {
        if ($isAnExternalLivewireFilter) {
            $watchForEvents = true;
        }

        return new self($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, $renderPillsAsHtml, $watchForEvents, $customResetButtonAttributes, $renderPillsTitleAsHtml);
    }

    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>|string|null
     */
    public function getPillValue(): array|string|null
    {
        return $this->filterPillValue;
    }

    public function getHasCustomPillBlade(): bool
    {
        return $this->hasCustomPillBlade;
    }

    public function getCustomPillBlade(): ?string
    {
        return $this->customPillBlade;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getCustomResetButtonAttributes(): array
    {
        return $this->customResetButtonAttributes;
    }

    public function getIsAnExternalLivewireFilter(): int
    {
        return intval($this->isAnExternalLivewireFilter);
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function shouldUsePillsAsHtml(): int
    {
        return intval($this->renderPillsAsHtml);
    }

    public function shouldUsePillsTitleAsHtml(): int
    {
        return intval($this->renderPillsTitleAsHtml);
    }

    public function shouldWatchForEvents(): int
    {
        return intval($this->watchForEvents);
    }

    public function isPillValueAnArray(): bool
    {
        return ! is_null($this->filterPillValue) && is_array($this->filterPillValue);
    }

    public function getSeparatedPillValue(): ?string
    {
        if ($this->isPillValueAnArray()) {
            return implode($this->getSeparator(), $this->getPillValue());
        } else {
            return $this->getPillValue();
        }
    }

    public function getSafeSeparatedPillValue(): ?string
    {
        $string = $this->getSeparatedPillValue();

        return htmlentities($string, ENT_QUOTES, 'UTF-8');

    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getFilterPillsItemAttributes(): array
    {
        return array_merge(['default' => true, 'default-colors' => true, 'default-styling' => true, 'default-text' => true], $this->filterPillsItemAttributes);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getFilterPillDisplayDataArray(): array
    {
        $array = [];
        if ($this->getIsAnExternalLivewireFilter()) {
            return $this->getExternalFilterPillDisplayDataArray($array);
        }

        return $this->getInternalFilterPillDisplayDataArray($array);
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $array
     * @return array<mixed>
     */
    public function getExternalFilterPillDisplayDataArray(array $array = []): array
    {
        $array[$this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text'] = 'displayString';

        return $array;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $array
     * @return array<mixed>
     */
    public function getInternalFilterPillDisplayDataArray(array $array = []): array
    {

        $array['x-data'] = "{ internalDisplayString: ''}";
        $array['x-init'] = 'internalDisplayString = updatePillValues('.json_encode($this->getSafeSeparatedPillValue()).')';
        $array[$this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text'] = 'internalDisplayString';

        return $array;
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $array
     * @return array<mixed>
     */
    public function getFilterTitleDisplayDataArray(array $array = []): array
    {
        $array[$this->shouldUsePillsTitleAsHtml() ? 'x-html' : 'x-text'] = 'localFilterTitle';

        return $array;
    }

    /**
     * Undocumented function
     *
     * @param string $filterKey
     * @param boolean $shouldWatch
     * @return array<mixed>
     */
    public function getPillSetupData(string $filterKey = '', bool $shouldWatch = false): array
    {
        $array = array_merge(['filterKey' => $filterKey, 'watchForEvents' => $shouldWatch], $this->toArray());

        return $array;
    }

    /**
     * Undocumented function
     *
     * @param string $filterKey
     * @param array<mixed> $filterPillsResetFilterButtonAttributes
     * @return array<mixed>
     */
    public function getCalculatedCustomResetButtonAttributes(string $filterKey, array $filterPillsResetFilterButtonAttributes): array
    {
        return array_merge(
            [
                'x-on:click.prevent' => "resetSpecificFilter('".$filterKey."')",
                'type' => 'button',
                'default' => true,
                'default-colors' => true,
                'default-styling' => true,
                'default-text' => true,
            ],
            $filterPillsResetFilterButtonAttributes,
            $this->getCustomResetButtonAttributes()
        );
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'filterKey' => $this->filterKey,
            'filterPillTitle' => $this->getTitle(),
            'filterPillValue' => $this->getPillValue(),
            'isAnExternalLivewireFilter' => $this->getIsAnExternalLivewireFilter(),
            'hasCustomPillBlade' => $this->getHasCustomPillBlade(),
            'customPillBlade' => $this->getCustomPillBlade(),
            'separator' => $this->getSeparator(),
            'separatedValues' => $this->getSafeSeparatedPillValue(),
            'filterPillsItemAttributes' => $this->getFilterPillsItemAttributes(),
            'renderPillsAsHtml' => $this->shouldUsePillsAsHtml(),
            'renderPillsTitleAsHtml' => $this->shouldUsePillsTitleAsHtml(),
            'watchForEvents' => $this->shouldWatchForEvents(),
        ];
    }
}
