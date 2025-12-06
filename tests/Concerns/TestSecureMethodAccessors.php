<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Concerns;

trait TestSecureMethodAccessors
{
    public function maBoolAccessor(string $methodName, bool $status): self
    {
        return $this->{$methodName}($status);
    }

    public function maMethodAccessor(string $methodName): self
    {
        return $this->{$methodName}();
    }


}