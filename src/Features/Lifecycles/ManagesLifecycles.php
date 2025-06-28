<?php

namespace Rappasoft\LaravelLivewireTables\Features\Lifecycles;

use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;

trait ManagesPropertyLifecycles
{
    public function updatedSelectedColumnsNew($data)
    {
        $this->selectedColumns = explode(";",$data);
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function updatedSelectedColumns(): void
    {
        $this->storeColumnSelectValues();
        $this->forceSelectedColumnsNew($this->selectedColumns);

        if(!$this->reloading)
        {

            // The query string isn't needed if it's the same as the default
            $this->forceSelectedColumnsNew($this->selectedColumns);


            if ($this->getEventStatusColumnSelect()) {
                event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
            }
        }
    }


    /**
     * Undocumented function
     *
     * @param integer|string $value
     * @return void
     */
    public function updatedPerPage(int|string $value): void
    {

        if(!$this->reloading)
        {
            if (! in_array((int) $value, $this->getPerPageAccepted(), false)) {
                $value = $this->getDefaultPerPage();
            }

            if (in_array(session($this->getPerPagePaginationSessionKey(), (int) $value), $this->getPerPageAccepted(), true)) {
                session()->put($this->getPerPagePaginationSessionKey(), (int) $value);
            } else {
                session()->put($this->getPerPagePaginationSessionKey(), $this->getPerPageAccepted()[0] ?? 10);
            }
            $this->setPerPage($value);
            $this->resetPage($this->getComputedPageName());

        }
    }


    /**
     * Undocumented function
     *
     * @param string|array<mixed>|null $value
     * @return void
     */
    public function updatedSearch(string|array|null $value): void
    {
        if(!$this->reloading)
        {
            if ($this->shouldTrimSearchString() && $this->search != trim($value)) {
                $this->search = $value = trim($value);
            }

            $this->resetComputedPage();

            // Clear bulk actions on search - if enabled
            if ($this->getClearSelectedOnSearch()) {
                $this->clearSelected();
                $this->setSelectAllDisabled();
            }

            if (is_null($value) || $value === '') {
                $this->clearSearch();
            }
        }
    }

}