<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Traits\{Configuration\ColumnConfiguration, HasClickable, HasColumnLabelStatus, HasColumnView, HasDataTableComponent, HasFooter, HasLabelFormat, HasRelations, HasSecondaryHeader, HasSlug, HasTextAlign, HasVisibility, Helpers\ColumnHelpers, IsCollapsible, IsReorderColumn, IsSearchable, IsSelectable, IsSortable};
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasAttributes, HasLabelAttributes, HasTheme};

class Column
{
    use HasLocalisations,
        HasDataTableComponent,
        IsReorderColumn,
        HasColumnLabelStatus,
        HasRelations,
        HasLabelFormat,
        HasClickable,
        HasSlug,
        ColumnConfiguration,
        ColumnHelpers,
        IsCollapsible,
        IsSearchable,
        IsSelectable,
        IsSortable,
        HasAttributes,
        HasColumnView,
        HasFooter,
        HasLabelAttributes,
        HasSecondaryHeader,
        HasTheme,
        HasVisibility,
        HasTextAlign;

    // What displays in the columns header
    protected string $title;

    // Act as a unique identifier for the column
    #[Locked]
    public string $hash;

    // The columns or relationship location: i.e. name, or address.group.name
    protected ?string $from = null;

    // The underlying columns name: i.e. name
    protected ?string $field = null;

    // The table of the columns or relationship
    public ?string $table = null;

    protected bool $html = false;

    protected bool $whitespaceWrap = false;

    protected ?int $columnIndex;

    protected ?int $rowIndex;

    /**
     * Undocumented variable
     */
    protected string $view = '';

    /**
     * Construct a Column
     */
    public function __construct(string $title, ?string $from = null)
    {
        $this->title = trim($title);

        if ($from) {
            $this->from = trim($from);
            $this->hash = md5($this->from);

            if (Str::contains($this->from, '.')) {
                $this->field = Str::afterLast($this->from, '.');
                $this->relations = explode('.', Str::beforeLast($this->from, '.'));
            } else {
                $this->field = $this->from;
            }
        } else {
            $this->field = Str::snake($title);
            $this->hash = md5($this->field);
        }
        $this->setDefaultSlug();
    }

    /**
     * Make a Column
     *
     * @return static
     */
    public static function make(string $title, ?string $from = null): Column
    {
        return new static($title, $from);
    }
}
