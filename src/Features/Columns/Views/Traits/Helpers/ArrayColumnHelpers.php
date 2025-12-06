<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers;

trait ArrayColumnHelpers
{
    public function hasSeparator(): bool
    {
        return $this->separator !== '';
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }

    public function hasDataCallback(): bool
    {
        return isset($this->dataCallback) && is_callable($this->dataCallback);
    }

    public function getDataCallback(): ?callable
    {
        return $this->dataCallback;
    }

    public function hasOutputFormatCallback(): bool
    {
        return isset($this->outputFormat) && is_callable($this->outputFormat);
    }

    public function getOutputFormatCallback(): ?callable
    {
        return $this->outputFormat;
    }

    public function hasOutputWrapperStart(): bool
    {
        return isset($this->outputWrapperStart) && $this->outputWrapperStart !== '';
    }

    public function getOutputWrapperStart(): string
    {
        return $this->outputWrapperStart;
    }

    public function hasOutputWrapperEnd(): bool
    {
        return isset($this->outputWrapperEnd) && $this->outputWrapperEnd !== '';
    }

    public function getOutputWrapperEnd(): string
    {
        return $this->outputWrapperEnd;
    }

    public function hasRelationship(): bool
    {
        return isset($this->relationship);
    }

    public function getRelationship(): string
    {
        return $this->relationship ?? '';
    }
}
