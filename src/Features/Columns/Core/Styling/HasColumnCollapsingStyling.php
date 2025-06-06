<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core\Styling;

use Livewire\Attributes\Computed;

trait HasColumnCollapsingStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $collapsingColumnButtonCollapseAttributes = ['default-styling' => true, 'default-colors' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $collapsingColumnButtonExpandAttributes = ['default-styling' => true, 'default-colors' => true];

    /**
     * Used to set attributes for the Collapsed Column Collapse Button
     *
     * @param  array<mixed>  $collapsingColumnButtonCollapseAttributes
     */
    public function setCollapsingColumnButtonCollapseAttributes(array $collapsingColumnButtonCollapseAttributes): self
    {
        $this->collapsingColumnButtonCollapseAttributes = [...$this->collapsingColumnButtonCollapseAttributes, ...$collapsingColumnButtonCollapseAttributes];

        return $this;
    }

    /**
     * Used to set attributes for the Collapsed Column Expand Button
     *
     * @param  array<mixed>  $collapsingColumnButtonExpandAttributes
     */
    public function setCollapsingColumnButtonExpandAttributes(array $collapsingColumnButtonExpandAttributes): self
    {
        $this->collapsingColumnButtonExpandAttributes = [...$this->collapsingColumnButtonCollapseAttributes, ...$collapsingColumnButtonExpandAttributes];

        return $this;
    }

    /**
     * Retrieves attributes for the Collapsed Column Collapse Button
     *     #[Computed]
     * @return array<mixed>
     */
    public function getCollapsingColumnButtonCollapseAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->collapsingColumnButtonCollapseAttributes];
    }

    /**
     * Retrieves attributes for the Collapsed Column Expand Button
     *     #[Computed]

     * @return array<mixed>
     */
    public function getCollapsingColumnButtonExpandAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->collapsingColumnButtonExpandAttributes];
    }

    
/**
 * Undocumented function
 *
 * @param array<mixed> $buttonAttributes
 * @return self
 */
    public function setCollapsingColumnButtonAttributes(array $buttonAttributes): self
    {
        if(array_key_exists('collapse', $buttonAttributes) || array_key_exists('expand', $buttonAttributes))
        {
            if(array_key_exists('collapse', $buttonAttributes))
            {
                $this->setCollapsingColumnButtonCollapseAttributes($buttonAttributes['collapse']);
            }
            if(array_key_exists('expand', $buttonAttributes))
            {
                $this->setCollapsingColumnButtonExpandAttributes($buttonAttributes['expand']);
            }
        }
        else
        {
            $this->setCollapsingColumnButtonCollapseAttributes($buttonAttributes[0]);
            $this->setCollapsingColumnButtonExpandAttributes($buttonAttributes[0]);
        }

        return $this;

    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getCollapsingColumnClasses(): array
    {
        $classes = '';
        $extras = [];
        foreach ($this->getCollapsedColumnsForContent() as $index => $col) {
            if ($this->isTailwind()) {
                if ($col->shouldCollapseAlways()) {
                    $classes = 'hidden';
                }
                if ($col->shouldCollapseOnMobile()) {
                    $classes = 'hidden md:table-cell';
                }
                if ($col->shouldCollapseOnTablet()) {
                    $classes = 'hidden lg:table-cell';
                }

            } elseif($this->isTailwind4()) {
                if ($col->shouldCollapseAlways()) {
                    $classes = 'hidden';
                }
                if ($col->shouldCollapseOnMobile()) {
                    $classes = 'hidden md:table-cell';
                }
                if ($col->shouldCollapseOnTablet()) {
                    $classes = 'hidden lg:table-cell';
                }
            } else {
                if ($col->shouldCollapseAlways()) {
                    $classes = 'd-none';
                }
                if ($col->shouldCollapseOnMobile()) {
                    $classes = 'd-none d-md-table-cell';
                }
                if ($col->shouldCollapseOnTablet()) {
                    $classes = 'd-none d-lg-table-cell';
                }

            }

            $extras[$index] = $classes;
        }

        return $extras;
    }

}