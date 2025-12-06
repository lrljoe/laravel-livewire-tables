<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Traits;

trait HasColumnSelectSessionStorage
{
    /**
     * Configures Storage of Column Select in Session
     *
     * @param boolean $status
     * @return self
     */
    public function storeColumnSelectInSessionStatus(bool $status): self
    {
        $this->setSessionStorageStatus('columnselect', $status);

        return $this;
    }

    /**
     * Enables Storage of Column Select in Session
     *
     * @return self
     */
    public function storeColumnSelectInSessionEnabled(): self
    {
        return $this->storeColumnSelectInSessionStatus(true);
    }

    /**
     * Disables Storage of Column Select in Session
     *
     * @return self
     */
    public function storeColumnSelectInSessionDisabled(): self
    {
        return $this->storeColumnSelectInSessionStatus(false);
    }

    public function shouldStoreColumnSelectInSession(): bool
    {
        return $this->getSessionStorageStatus('columnselect');
    }

    public function getColumnSelectSessionKey(): string
    {
        return $this->getTableName().'-stored-columnselect';
    }

    public function storeColumnSelectValues(): void
    {
        if ($this->shouldStoreColumnSelectInSession()) {
            $this->clearStoredColumnSelectValues();
            session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
        }
    }

    public function restoreColumnSelectValues(): void
    {
        $this->selectedColumns = $this->getStoredColumnSelectValues();
        $this->pushToQueryString($this->selectedColumns);
    }

    /**
     * Undocumented function
     *
     * @return array<mixed>
     */
    public function getStoredColumnSelectValues(): array
    {
        if ($this->shouldStoreColumnSelectInSession() && session()->has($this->getColumnSelectSessionKey())) {
            return session()->get($this->getColumnSelectSessionKey());
        }

        return [];
    }

    public function clearStoredColumnSelectValues(): void
    {
        if ($this->shouldStoreColumnSelectInSession() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }
    }

    protected function forgetColumnSelectSession(): void
    {
        session()->forget($this->getColumnSelectSessionKey());
    }
}