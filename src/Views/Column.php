<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\{HasDataTableComponent,IsReorderColumn,HasColumnLabelStatus,HasRelations,HasLabelFormat,HasClickable,HasSlug,IsCollapsible,IsSearchable,IsSelectable,IsSortable,HasColumnView,HasFooter,HasSecondaryHeader,HasVisibility, Configuration\ColumnConfiguration, Helpers\ColumnHelpers};
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
        HasVisibility;

    // What displays in the columns header
    protected string $title;

    // Act as a unique identifier for the column
    protected string $hash;

    // The columns or relationship location: i.e. name, or address.group.name
    protected ?string $from = null;

    // The underlying columns name: i.e. name
    protected ?string $field = null;

    // The table of the columns or relationship
    protected ?string $table = null;

    protected bool $html = false;

    protected ?int $columnIndex;

    protected ?int $rowIndex;

    protected string $view = '';

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
    }

    /**
     * @return static
     */
    public static function make(string $title, ?string $from = null): Column
    {
        return new static($title, $from);
    }
}
