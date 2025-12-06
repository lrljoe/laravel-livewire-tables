<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Views\Traits;

trait HandlesConfirmationMessage
{
    public ?string $confirmationMessage;

    public function setConfirmationMessage(string $confirmationMessage) :self
    {
        $this->confirmationMessage = $confirmationMessage;

        return $this;
    }

    public function hasConfirmationMessage() :bool
    {
        return isset($this->confirmationMessage);
    }

}