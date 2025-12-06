<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait HandlesFieldName
{
    /**
     * The Field Name for a Filter
     */
    protected ?string $fieldName;

    /**
     * Sets the Field Name for a Filter
     */
    public function setFieldName(string $fieldName): self
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Determines if a Filter has a Field Name configured
     */
    public function hasFieldName(): bool
    {
        return isset($this->fieldName);

    }

    /**
     * Retrieves the Field Name for a Filter
     */
    public function getFieldName(): string
    {
        return $this->fieldName;

    }
}
