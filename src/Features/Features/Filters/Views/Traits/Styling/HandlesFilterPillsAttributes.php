<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;

trait HandlesFilterPillsAttributes
{
    /**
     * [Description for $pillAttributes]
     *
     * @var array<mixed>
     */
    protected array $pillAttributes = [];

    /**
     * [Description for $pillResetButtonAttributes]
     *
     * @var array<mixed>
     */
    protected array $pillResetButtonAttributes = [];

    protected bool $pillTitleAsHtml = false;

    /**
     * Undocumented function
     */
    public function getPillAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getPillAttributes());
    }

    /**
     * Undocumented function
     */
    public function hasPillAttributes(): bool
    {
        return ! empty($this->pillAttributes);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getPillAttributes(): array
    {
        $attributes = array_merge(['default-colors' => true, 'default-styling' => true], $this->pillAttributes);
        ksort($attributes);

        return $attributes;
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $pillAttributes
     */
    public function setPillAttributes(array $pillAttributes): self
    {
        $this->pillAttributes = array_merge([
            'default-colors' => true,
            'default-styling' => true,
        ], $pillAttributes);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $attributes
     */
    public function setPillResetButtonAttributes(array $attributes = []): self
    {
        $this->pillResetButtonAttributes = [...$this->getPillResetButtonAttributes(), ...$attributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getPillResetButtonAttributes(): array
    {
        return $this->pillResetButtonAttributes ?? [];
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $resetFilterButtonAttributes
     * @return array<mixed>
     */
    public function getFilterPillResetButtonAttributesMerged(array $resetFilterButtonAttributes): array
    {
        return array_merge(
            [
                'x-on:click.prevent' => "resetSpecificFilter('".$this->getKey()."')",
                'type' => 'button',
            ],
            $resetFilterButtonAttributes,
            $this->getPillResetButtonAttributes()
        );
    }

    /**
     * Undocumented function
     */
    public function setFilterPillTitleAsHtml(bool $pillTitleAsHtml): self
    {
        $this->pillTitleAsHtml = $pillTitleAsHtml;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function getFilterPillTitleAsHtml(): bool
    {
        return $this->pillTitleAsHtml;
    }
}
