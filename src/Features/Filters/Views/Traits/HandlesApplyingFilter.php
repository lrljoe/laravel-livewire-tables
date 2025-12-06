<?php

namespace Rappasoft\LaravelLivewireTables\Features\Filters\Views\Traits;

trait HandlesApplyingFilter
{
    use HandlesFieldName;

    /**
     * Determines if Filter is already applied
     *
     * @var boolean
     */
    protected bool $hasAppliedFilterAlready = false;

    /**
     * Detects if Filter should be applied
     *
     * @param string|null $fieldName
     * @return boolean
     */
    protected function shouldApplyFilter(?string $fieldName = null): bool
    {
        if (isset($fieldName)) {
            $this->setFieldName($fieldName);
        }
        if ($this->hasFieldName()) {
            if (! $this->hasAppliedFilterAlready) {
                $this->hasAppliedFilterAlready = true;

                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
