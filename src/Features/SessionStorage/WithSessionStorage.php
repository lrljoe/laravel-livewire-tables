<?php

namespace Rappasoft\LaravelLivewireTables\Features\SessionStorage;

trait WithSessionStorage
{

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $sessionStorageStatus = [
        'columnselect' => false,
        'filters' => false,
    ];

    /**
     * Session Storage Key
     *
     * @var string|null
     */
    protected ?string $sessionStorageKey;

    /**
     * Set Session Storage Status
     *
     * @param string $name
     * @param boolean $status
     * @return self
     */
    protected function setSessionStorageStatus(string $name, bool $status): self
    {
        $this->sessionStorageStatus[$name] = $status;
        
        return $this;
    }

    protected function getSessionStorageStatus(string $name): bool
    {
        return $this->sessionStorageStatus[$name] ?? false;
    }

    /**
     * Set Session Storage Key
     *
     * @param string $key
     * @return self
     */
    protected function setSessionStorageKey(string $key): self
    {
        $this->sessionStorageKey = $key;
        
        return $this;
    }

    protected function getSessionStorageKey(): string
    {
        return $this->sessionStorageKey ?? $this->getTableName();
    }

}
