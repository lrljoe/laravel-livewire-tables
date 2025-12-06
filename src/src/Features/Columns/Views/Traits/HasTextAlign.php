<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits;

trait HasTextAlign
{
    protected ?string $textAlign;
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasTextAlign(): bool
    {
        return isset($this->textAlign);
    }

    public function getTextAlign(): string
    {
        if(!$this->hasTextAlign())
        {
            throw new \Rappasoft\LaravelLivewireTables\Exceptions\MissingProperties\TextAlignMissing('Text Align Is Not Set');
        }
        return $this->textAlign;
    }

    public function setTextAlign(string $textAlign): self
    {
        if($textAlign == 'left' || $textAlign == 'center' || $textAlign == 'right')
        {
            $this->textAlign = $textAlign;
        }
        
        return $this;
    }

    public function setTextAlignLeft(): self
    {
        return $this->setTextAlign('left');
    }

    public function setTextAlignCenter(): self
    {
        return $this->setTextAlign('center');
    }

    public function setTextAlignRight(): self
    {
        return $this->setTextAlign('right');
    }

}