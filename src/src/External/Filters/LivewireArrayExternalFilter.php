<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters;

use Livewire\Attributes\{Locked, Modelable, Renderless};
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\External\Filters\Traits\{HandlesCoreMethodsForExternalFilter,HandlesCorePropertiesForExternalFilter,HandlesTableEventsForExternalFilter, HandlesUpdateStatusForExternalFilter};

abstract class LivewireArrayExternalFilter extends Component
{
    use HandlesCoreMethodsForExternalFilter,
        HandlesCorePropertiesForExternalFilter,
        HandlesTableEventsForExternalFilter,
        HandlesUpdateStatusForExternalFilter;

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Modelable]
    public array $value = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
     #[Locked]
    public array $optionsAvailable = [];
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $optionsSelected = [];
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $selectedItems = [];

    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    public array $returnValues = [];

    #[Renderless]
    public function updatedOptionsSelected(mixed $value): void
    {

        if (! $this->skipUpdate) {
            if (! $this->needsUpdating) {
                $this->needsUpdating = true;
            }
        }
    }
}
