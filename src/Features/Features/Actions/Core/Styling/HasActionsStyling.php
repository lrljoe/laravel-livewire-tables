<?php

namespace Rappasoft\LaravelLivewireTables\Features\Actions\Core\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasActionsStyling
{
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $actionWrapperAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $actionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented variable
     *
     * @var array<mixed>|null
     */
    protected ?array $actionsMenuTransitionAttributes;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    protected array $actionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['class' => '', 'default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $actionWrapperAttributes
     */
    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...$this->actionWrapperAttributes, ...$actionWrapperAttributes];

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $actionsMenuAttributes
     */
    public function setActionMenuAttributes(array $actionsMenuAttributes): self
    {
        $this->actionsMenuAttributes = [...$this->actionsMenuAttributes, ...$actionsMenuAttributes];

        return $this;
    }

    /**
     * Used to get attributes for the Bulk Actions Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getActionsButtonAttributes(): array
    {
        return [...['x-ref' => 'actionsMenuButton', 'type' => 'button', 'aria-haspopup' => 'false'], ...(($this->isTailwind() || $this->isTailwind4()) ? ['x-on:click' => 'open = !open'] : ['data-toggle' => 'dropdown', 'data-bs-toggle' => 'dropdown']), ...$this->getCustomAttributes('actionsButtonAttributes', true)];

    }

    /**
     * Undocumented function
     */
    public function getActionsButtonAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getActionsButtonAttributes());
    }

    /**
     * Used to get attributes for the Actions Menu (Dropdown)
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getActionsMenuAttributes(): array
    {
        return [...$this->getCoreMenuAttributes(), ...(($this->isTailwind() || $this->isTailwind4()) ? ['x-anchor.bottom-start' => '$refs.actionsMenuButton'] : []), ...$this->getActionsMenuTransitionAttributes(), ...$this->getCustomAttributes('actionsMenuAttributes', true, false)];
    }

    /**
     * Gets Actions Menu Transition Attributes
     *
     * @return array<mixed>
     */
    protected function getActionsMenuTransitionAttributes(): array
    {
        if ($this->isTailwind() || $this->isTailwind4()) {
            return isset($this->actionsMenuTransitionAttributes) ? $this->actionsMenuTransitionAttributes : $this->getCoreTransitionAttributes();
        }

        return [];
    }
}
