<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers;

use Illuminate\View\ComponentAttributeBag;

trait ObscureColumnHelpers {
    
    /**
     * This handles the Obscured Content Attributes for Columns
     *
     * @return ComponentAttributeBag
     */
    public function getObscureContentAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->obscureSettings['wrapperAttributes']);
    }

    public function getShouldObscure(): bool
    {
        return $this->obscureSettings['enabled'];
    }


    /* Default Click Behaviour Section */

    /**
     * Retrieves the Default Click Behaviour Status
     *
     * @return boolean
     */
    public function getObscureDefaultClickBehaviour(): bool
    {
        return $this->obscureSettings['defaultClickEnabled'];
    }


    /**
     * Retreives Default Click Attributes
     *
     * @return array<mixed>
     */
    public function getObscureDefaultClickAttributes(): array
    {
        return $this->getObscureDefaultClickBehaviour() ? ['x-on:click.prevent' => 'obscure = !obscure'] : [];
    }

}
