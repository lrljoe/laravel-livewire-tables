<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Configuration\ArrayColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\Helpers\ArrayColumnHelpers;

class ArrayColumn extends Column
{
    use ArrayColumnConfiguration,
        ArrayColumnHelpers;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $separator = '<br />';

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $emptyValue = '';

    /**
     * Undocumented variable
     *
     * @var mixed
     */
    protected mixed $dataCallback = null;

    /**
     * Undocumented variable
     *
     * @var mixed
     */
    protected mixed $outputFormat = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $outputWrapperStart;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    public ?string $outputWrapperEnd;

    public ?string $relationship;

    /**
     * Undocumented function
     *
     * @param string $title
     * @param string|null $from
     */
    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }
    }

    /**
     * Undocumented function
     *
     * @param Model $row
     * @return null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $outputValues = [];
        $value = $this->getValue($row);

        if (! $this->hasDataCallback()) {
            throw new DataTableConfigurationException('You must set a data() method on an ArrayColumn');
        }

        if (! $this->hasOutputFormatCallback()) {
            throw new DataTableConfigurationException('You must set an outputFormat() method on an ArrayColumn');
        }

        foreach (call_user_func($this->getDataCallback(), $value, $row) as $i => $v) {
            $outputValues[] = call_user_func($this->getOutputFormatCallback(), $i, $v);
        }
        asort($outputValues);
        
        $returnedValue = (! empty($outputValues) ? implode($this->getSeparator(), $outputValues) : $this->getEmptyValue());

        if ($this->hasOutputWrapperStart() && $this->hasOutputWrapperEnd())
        {
            $returnedValue = $this->getOutputWrapperStart() . $returnedValue . $this->getOutputWrapperEnd();
        }
        return new HtmlString($returnedValue);
    }
}
