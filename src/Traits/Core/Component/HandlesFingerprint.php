<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Component;

use Livewire\Attributes\Locked;

trait HandlesFingerprint
{
    #[Locked]
    public ?string $dataTableFingerprint;

    public function getDataTableFingerprint(): string
    {
        if(!isset($this->dataTableFingerprint))
        {
            $this->dataTableFingerprint = $this->generateDataTableFingerprint();
        }
        return $this->dataTableFingerprint;
    }

    public function setDataTableFingerprint(string $dataTableFingerprint): self
    {
        $this->dataTableFingerprint = $dataTableFingerprint;

        return $this;
    }

    /**
     * Returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
     */
    protected function generateDataTableFingerprint(): string
    {
        $className = str_split(static::class);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return $this->getTableName().'_'.base_convert($crc32, 10, 36);
    }
}
