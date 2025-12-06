<?php

namespace Rappasoft\LaravelLivewireTables\Features\BulkActions\Views\Traits;

use Illuminate\View\ComponentAttributeBag;

trait HandlesBulkActionAttributes
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $buttonAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true,  'role' => 'menuitem', 'type' => 'button'];

    /**
     * Undocumented function
     *
     * @param array<mixed> $buttonAttributes
     * @return self
     */
    public function setButtonAttributes(array $buttonAttributes): self
    {
        $this->buttonAttributes = [...$this->buttonAttributes, ...$buttonAttributes];
        
        return $this;
    }
    
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasButtonAttributes(): bool
    {
        return $this->buttonAttributes != ['class' => '', 'default-styling' => true, 'default-colors' => true,  'role' => 'menuitem', 'type' => 'button'];
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getButtonAttributes(): array
    {
        $default = ['class' => '', 'default-styling' => true, 'default-colors' => true,  'role' => 'menuitem', 'type' => 'button', 'wire:click' => $this->action];
        if($this->hasConfirmationMessage())
        {
            $default['wire:confirm'] = $this->confirmationMessage;
        }
        $merged = [...$default, ...$this->buttonAttributes];
        ksort($merged);
        return $merged;
    }

    /**
     * Undocumented function
     *
     * @return ComponentAttributeBag
     */
    public function getButtonAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getButtonAttributes());
    }
}
