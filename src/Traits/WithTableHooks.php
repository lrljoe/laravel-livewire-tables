<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use function Livewire\wrap;

trait WithTableHooks
{
    /**
     * Undocumented function
     *
     * @param  array<mixed>  $params
     */
    public function callHook(string $name, array $params = []): void
    {
        if (method_exists($this, $name)) {
            wrap($this)->__call($name, $params);
        }
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $params
     */
    public function callTraitHook(string $name, array $params = []): void
    {
        foreach (class_uses_recursive($this) as $trait) {
            $method = $name.class_basename($trait);

            if (method_exists($this, $method)) {
                wrap($this)->$method(...$params);
            }
        }
    }
}
