<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration;

trait ObscureColumnConfiguration 
{

    /**
     * Used in the setupColumns() method to configure the behaviours for the Column
     *
     * @return self
     */
    public function setupObscuration(): self
    {
        if($this->getShouldObscure())
        {
            $this->obscureSettings['wrapperAttributes'] = array_merge($this->obscureSettings['wrapperAttributes'], $this->getObscureDefaultClickAttributes(), $this->obscureSettings['customAttributes']);
        }
        $this->obscureSettings['wrapperAttributes']['x-data'] = $this->getShouldObscure() ? "{ obscure: true }" : "{ obscure: false }";

        return $this;
    }

    /**
     * Shortened version allowing for setting up Obscuration on a Column without repetitive calls
     *
     * @param boolean $enabled
     * @param boolean $defaultClickEnabled
     * @param array<mixed> $customAttributes
     * @return self
     */
    public function configureObscuration(bool $enabled = true, bool $defaultClickEnabled = true, array $customAttributes = []): self
    {
        return $this->setShouldObscure($enabled)
            ->setObscureDefaultClickBehaviour(($enabled && $defaultClickEnabled))
            ->setObscureCustomContentAttributes($customAttributes);
    }

    protected function setShouldObscure(bool $status): self
    {
        $this->obscureSettings['enabled'] = $status;
        if($status)
        {
            $this->obscureSettings['wrapperAttributes']['x-data'] = "{ obscure: true }";
            $this->obscureSettings['wrapperAttributes']['x-on:click.prevent'] = "obscure = !obscure";
        }
        else
        {
            $this->obscureSettings['wrapperAttributes']['x-data'] = "{ obscure: false }";
        }

        return $this;
    }

    public function setShouldObscureEnabled(): self
    {
        return $this->setShouldObscure(true);
    }

    public function setShouldObscureDisabled(): self
    {
        return $this->setShouldObscure(false);
    }

    protected function setObscureDefaultClickBehaviour(bool $status): self
    {
        
        $this->obscureSettings['defaultClickEnabled'] = $status;
        if($status)
        {
            $this->obscureSettings['wrapperAttributes']['x-on:click.prevent'] = "obscure = !obscure";
        }
        else
        {
            unset($this->obscureSettings['wrapperAttributes']['x-on:click.prevent']);
        }

        return $this;
    }

    public function setObscureDefaultClickBehaviourEnabled(): self
    {
        return $this->setObscureDefaultClickBehaviour(true);
    }

    public function setObscureDefaultClickBehaviourDisabled(): self
    {
        return $this->setObscureDefaultClickBehaviour(false);
    }

    /* Custom Attributes Section */

    /**
     * Sets Custom Attributes for use on the Obscuration wrapper
     *
     * @param array<mixed> $attributes
     * @return self
     */
    public function setObscureCustomContentAttributes(array $attributes = []): self
    {
        $this->obscureSettings['customAttributes'] = $attributes;

        return $this;
    }

    public function setObscureMask(string $mask = ""): self
    {
        $this->mask = $mask;

        return $this;
    }


}
