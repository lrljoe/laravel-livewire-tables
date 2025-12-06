<?php

namespace Rappasoft\LaravelLivewireTables\Features\Pagination\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Livewire\Attributes\Renderless;

trait PaginationConfiguration
{
    /**
     * Undocumented function
     *
     * @param string $name
     * @return self
     */
    public function setPageName(string $name): self
    {
        $this->pageName = $name;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setPaginationStatus(bool $status): self
    {
        $this->setPaginationConfig('paginationStatus',$status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPaginationEnabled(): self
    {
        return $this->setPaginationStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPaginationDisabled(): self
    {
        return $this->setPaginationStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setPaginationVisibilityStatus(bool $status): self
    {
        $this->setPaginationConfig('paginationVisibilityStatus',$status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPaginationVisibilityEnabled(): self
    {
        return $this->setPaginationVisibilityStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPaginationVisibilityDisabled(): self
    {
        return $this->setPaginationVisibilityStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setPerPageVisibilityStatus(bool $status): self
    {
        $this->setPaginationConfig('perPageVisibilityStatus',$status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPerPageVisibilityEnabled(): self
    {
        return $this->setPerPageVisibilityStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setPerPageVisibilityDisabled(): self
    {
        return $this->setPerPageVisibilityStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $accepted
     * @return self
     */
    public function setPerPageAccepted(array $accepted): self
    {
        $this->setPaginationConfig('perPageAccepted',$accepted);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param integer $perPage
     * @throws DataTableConfigurationException
     * @return self
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
     *
     * @return self
     */
    public function unsetPerPage(): self
    {
        $this->perPage = null;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $paginationMethod
     * @return self
     */
    public function setPaginationMethod(string $paginationMethod): self
    {
        $this->paginationMethod = $paginationMethod;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setDisplayPaginationDetails(bool $status): self
    {
        $this->setPaginationConfig('shouldShowPaginationDetails',$status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setDisplayPaginationDetailsEnabled(): self
    {
        return $this->setDisplayPaginationDetails(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setDisplayPaginationDetailsDisabled(): self
    {
        return $this->setDisplayPaginationDetails(false);
    }

    /**
     * Set a default per-page value (if not set already by session or querystring)
     *
     * @param integer $defaultPerPage
     * @return self
     */
    public function setDefaultPerPage(int $defaultPerPage): self
    {
        if (in_array((int) $defaultPerPage, $this->getPerPageAccepted())) {
            $this->setPaginationConfig('defaultPerPage',$defaultPerPage);
        }

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $status
     * @return self
     */
    public function setShouldRetrieveTotalItemCountStatus(bool $status): self
    {
        $this->setPaginationConfig('shouldRetrieveTotalItemCount',$status);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setShouldRetrieveTotalItemCountEnabled(): self
    {
        return $this->setShouldRetrieveTotalItemCountStatus(true);
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function setShouldRetrieveTotalItemCountDisabled(): self
    {
        return $this->setShouldRetrieveTotalItemCountStatus(false);
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param mixed $value
     * @return self
     */
    protected function setPaginationConfig(string $key, mixed $value): self
    {
        $this->paginationConfig[$key] = $value;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param boolean $paginationStatus
     * @param boolean $perPageVisibilityStatus
     * @param array<mixed> $perPageAccepted
     * @param integer $perPage
     * @param integer $page
     * @return void
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
