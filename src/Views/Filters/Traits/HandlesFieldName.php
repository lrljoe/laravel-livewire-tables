<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesFieldName
{
    /**
     * The Field Name for a Filter
     *
     * @var string|null
     */
    protected ?string $fieldName;

    /**
     * Sets the Field Name for a Filter
     *
     * @param string $fieldName
     * @return self
     */
    public function setFieldName(string $fieldName): self
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Determines if a Filter has a Field Name configured
     *
     * @return boolean
     */
    public function hasFieldName(): bool
    {
        return isset($this->fieldName);

    }

    /**
     * Retrieves the Field Name for a Filter
     *
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;

    }
}
