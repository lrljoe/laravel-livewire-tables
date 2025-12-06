<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pagination\Configuration;

use Livewire\Attributes\Renderless;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait PaginationConfiguration
{
    /**
     * Undocumented function
     */
    public function setPageName(string $name): self
    {
        $this->pageName = $name;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setPaginationStatus(bool $status): self
    {
        $this->setPaginationConfig('paginationStatus', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setPaginationEnabled(): self
    {
        return $this->setPaginationStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setPaginationDisabled(): self
    {
        return $this->setPaginationStatus(false);
    }

    /**
     * Undocumented function
     */
    public function setPaginationVisibilityStatus(bool $status): self
    {
        $this->setPaginationConfig('paginationVisibilityStatus', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setPaginationVisibilityEnabled(): self
    {
        return $this->setPaginationVisibilityStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setPaginationVisibilityDisabled(): self
    {
        return $this->setPaginationVisibilityStatus(false);
    }

    /**
     * Undocumented function
     */
    public function setPerPageVisibilityStatus(bool $status): self
    {
        $this->setPaginationConfig('perPageVisibilityStatus', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setPerPageVisibilityEnabled(): self
    {
        return $this->setPerPageVisibilityStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setPerPageVisibilityDisabled(): self
    {
        return $this->setPerPageVisibilityStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $accepted
     */
    public function setPerPageAccepted(array $accepted): self
    {
        $this->setPaginationConfig('perPageAccepted', $accepted);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @throws DataTableConfigurationException
     */
    public function setPerPage(int $perPage): self
    {
        if (! in_array($perPage, $this->getPerPageAccepted(), true)) {
            throw new DataTableConfigurationException('You can only set per page values that are in your accepted values list.');
        }

        $this->perPage = $perPage;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function unsetPerPage(): self
    {
        $this->perPage = null;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setPaginationMethod(string $paginationMethod): self
    {
        $this->paginationMethod = $paginationMethod;

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setDisplayPaginationDetails(bool $status): self
    {
        $this->setPaginationConfig('shouldShowPaginationDetails', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setDisplayPaginationDetailsEnabled(): self
    {
        return $this->setDisplayPaginationDetails(true);
    }

    /**
     * Undocumented function
     */
    public function setDisplayPaginationDetailsDisabled(): self
    {
        return $this->setDisplayPaginationDetails(false);
    }

    /**
     * Set a default per-page value (if not set already by session or querystring)
     */
    public function setDefaultPerPage(int $defaultPerPage): self
    {
        if (in_array((int) $defaultPerPage, $this->getPerPageAccepted())) {
            $this->setPaginationConfig('defaultPerPage', $defaultPerPage);
        }

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setShouldRetrieveTotalItemCountStatus(bool $status): self
    {
        $this->setPaginationConfig('shouldRetrieveTotalItemCount', $status);

        return $this;
    }

    /**
     * Undocumented function
     */
    public function setShouldRetrieveTotalItemCountEnabled(): self
    {
        return $this->setShouldRetrieveTotalItemCountStatus(true);
    }

    /**
     * Undocumented function
     */
    public function setShouldRetrieveTotalItemCountDisabled(): self
    {
        return $this->setShouldRetrieveTotalItemCountStatus(false);
    }

    /**
     * Undocumented function
     */
    protected function setPaginationConfig(string $key, mixed $value): self
    {
        $this->paginationConfig[$key] = $value;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param  array<mixed>  $perPageAccepted
     */
    protected function restorePaginationConfig(bool $paginationStatus, bool $perPageVisibilityStatus, array $perPageAccepted, int $perPage, int $page): void
    {
        $this->setPaginationStatus($paginationStatus)
            ->setPerPageVisibilityStatus($perPageVisibilityStatus)
            ->setPerPageAccepted($perPageAccepted)
            ->setPerPage($perPage)
            ->setPage($page, $this->getComputedPageName());
    }
}
