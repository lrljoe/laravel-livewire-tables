<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    public string $tableName;

    public ?string $key;

    /**
     * Undocumented variable
     *
     * @var string|array<mixed>|null
     */
    public string|array|null $value;

    public ?Authenticatable $user;

    public function setKeyForEvent(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string|array<mixed> $value
     * @return self
     */
    public function setValueForEvent(string|array $value): self
    {
        $this->value = $value;

        return $this;

    }

    public function setTableForEvent(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function setUserForEvent(): self
    {
        if (config('livewire-tables.events.enableUserForEvent', true) && auth()->user()) {
            $this->user = auth()->user();
        }

        return $this;
    }
}
