<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ReorderingConfiguration
{
    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setReorderStatus(bool $status): self
    {
        $this->reorderConfig['reorderStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setReorderEnabled(): self
    {
        return $this->setReorderStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setReorderDisabled(): self
    {
        return $this->setReorderStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setCurrentlyReorderingStatus(bool $status): self
    {
        $this->reorderConfig['currentlyReorderingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setCurrentlyReorderingEnabled(): self
    {
        return $this->setCurrentlyReorderingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setCurrentlyReorderingDisabled(): self
    {
        return $this->setCurrentlyReorderingStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingStatus(bool $status): self
    {
        $this->reorderConfig['hideReorderColumnUnlessReorderingStatus'] = $status;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingEnabled(): self
    {
        return $this->setHideReorderColumnUnlessReorderingStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setHideReorderColumnUnlessReorderingDisabled(): self
    {
        return $this->setHideReorderColumnUnlessReorderingStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $method
     * @return self
     */
    public function setReorderMethod(string $method): self
    {
        $this->reorderConfig['reorderMethod'] = $method;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $field
     * @param string $direction
     * @return self
     */
    public function setDefaultReorderSort(string $field, string $direction = 'asc'): self
    {
        $this->reorderConfig['defaultReorderColumn'] = $field;
        $this->reorderConfig['defaultReorderDirection'] = $direction;

        return $this;
    }
}
