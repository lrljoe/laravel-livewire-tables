<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

#[Group('Columns')]
final class ColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = Column::make('Name', 'name');
    }

    public function test_can_set_the_column_title(): void
    {
        $this->assertSame('Name', self::$columnInstance->getTitle());
    }

    public function test_can_infer_field_name_from_title_if_no_from(): void
    {
        $column = Column::make('My Title');

        $this->assertSame('my_title', $column->getField());
    }

    public function test_can_set_base_field_from_from(): void
    {
        $this->assertSame('name', self::$columnInstance->getField());
    }

    public function test_can_set_relation_field_from_from(): void
    {
        $column = Column::make('Address Group Name', 'address.group.name');

        $this->assertSame('name', $column->getField());
    }

    public function test_can_set_relations_from_from(): void
    {
        $column = Column::make('Address Group Name', 'address.group.name');

        $this->assertSame(['address', 'group'], $column->getRelations()->toArray());
        $this->assertSame('address.group', $column->getRelationString());
    }

    public function test_can_get_contents_of_column(): void
    {
        // TODO: Figure out how to call getContents on a row object to verify that way
        $rows = $this->basicTable->getRows();
        $this->assertSame('Cartman', $rows->first()->name);
        $this->assertSame('Norwegian Forest', $rows->first()['breed.name']);
    }

    public function test_can_get_column_formatted_contents(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');
        $rows = $this->basicTable->getRows();

        $this->assertFalse($column->hasFormatter());
        $this->assertNull($column->getFormatCallback());

        $column->format(fn ($value) => strtoupper($value));

        $this->assertTrue($column->hasFormatter());
        $this->assertNotNull($column->getFormatCallback());

        $this->assertSame(strtoupper($rows->first()->name), $column->getContents($rows->first()));
    }

    public function test_column_table_gets_set_for_base_and_relationship_columns(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');

        $this->assertSame('pets', $column->getTable());

        $column = $this->basicTable->getColumnBySelectName('breed.name');

        $this->assertSame('breed', $column->getTable());
    }

    public function test_can_check_ishtml_from_html_column(): void
    {
        $column = self::$columnInstance;
        $this->assertFalse($column->isHtml());
        $column = $column->html();
        $this->assertTrue($column->isHtml());
    }

    public function test_can_get_html_from_html_label_column(): void
    {
        $column = self::$columnInstance;
        $column = $column->label(fn () => '<strong>My Label</strong>')->html();
        $rows = $this->basicTable->getRows();
        $htmlString = new \Illuminate\Support\HtmlString('<strong>My Label</strong>');
        $this->assertSame($htmlString->toHtml(), $column->getContents($rows->first())->toHtml());
    }

    public function test_can_get_html_from_html_format_column(): void
    {
        $column = $this->basicTable->getColumnBySelectName('name');
        $rows = $this->basicTable->getRows();

        $column->format(fn ($value) => strtoupper($value))->html();

        $htmlString = new \Illuminate\Support\HtmlString(strtoupper($rows->first()->name));

        $this->assertSame($htmlString->toHtml(), $column->getContents($rows->first())->toHtml());
    }

    public function test_cannot_collapse_on_tablet_and_mobile(): void
    {
        $rows = $this->basicTable->getRows();
        $column = self::$columnInstance;
        $column = $column->label(fn () => '<strong>My Label</strong>')->collapseOnMobile()->collapseOnTablet()->html();
        $this->expectException(DataTableConfigurationException::class);

        $contents = $column->renderContents($rows->first());
    }

    public function test_custom_sorting_pills_defaults_correctly(): void
    {
        //$column = Column::make('Name', 'name');
        $defaultString = __($this->basicTable->getLocalisationPath().'not_applicable');

        $this->assertSame('A-Z', self::$columnInstance->getCustomSortingPillDirections('asc'));
        $this->assertSame('Z-A', self::$columnInstance->getCustomSortingPillDirections('desc'));
        $this->assertSame($defaultString, self::$columnInstance->getCustomSortingPillDirections('faulty_string'));

    }

    public function test_custom_sorting_pills_label_defaults_correctly(): void
    {
        $defaultString = __($this->basicTable->getLocalisationPath().'not_applicable');

        $this->assertSame('A-Z', self::$columnInstance->getCustomSortingPillDirectionsLabel('asc'));
        $this->assertSame('Z-A', self::$columnInstance->getCustomSortingPillDirectionsLabel('desc'));
        $this->assertSame($defaultString, self::$columnInstance->getCustomSortingPillDirectionsLabel('faulty_string'));

    }
}
