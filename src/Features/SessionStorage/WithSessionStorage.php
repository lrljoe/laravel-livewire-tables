<?php

namespace Rappasoft\LaravelLivewireTables\Features\SessionStorage;

use Livewire\Attributes\Locked;

trait WithSessionStorage
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $sessionStorageStatus = [
        'columnselect' => true,
        'filters' => false,
    ];

    /**
     * Session Storage Key
     */
    protected ?string $sessionStorageKey;

    /**
     * Set Session Storage Status
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
