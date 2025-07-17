<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns\Concerns;

trait ProvidesTestsForColumnTextAlignment
{

    public function test_can_validate_text_align_presence(): void
    {
        $test = self::$columnInstance;

        $this->assertFalse($test->hasTextAlign());

        $test->setTextAlignLeft();

        $this->assertTrue($test->hasTextAlign());
    }

    public function test_can_validate_text_align_left(): void
    {
        $test = self::$columnInstance;
        $this->assertFalse($test->hasTextAlign());
        $test->setTextAlignLeft();
        $this->assertTrue($test->hasTextAlign());
        $this->assertSame('left',$test->getTextAlign());

    }

    public function test_can_validate_text_align_center(): void
    {
        $test = self::$columnInstance;
        $this->assertFalse($test->hasTextAlign());
        $test->setTextAlignCenter();
        $this->assertTrue($test->hasTextAlign());
        $this->assertSame('center',$test->getTextAlign());

    }

    public function test_can_validate_text_align_right(): void
    {
        $test = self::$columnInstance;
        $this->assertFalse($test->hasTextAlign());
        $test->setTextAlignRight();
        $this->assertTrue($test->hasTextAlign());
        $this->assertSame('right',$test->getTextAlign());
    }

    public function test_can_not_set_invalid_text_align(): void
    {
        $test = self::$columnInstance;
        $this->assertFalse($test->hasTextAlign());
        $test->setTextAlign('random');
        $this->assertFalse($test->hasTextAlign());
    }

    public function test_can_not_set_invalid_text_align_and_retrieve_it(): void
    {
        $this->expectException(\Rappasoft\LaravelLivewireTables\Exceptions\MissingProperties\TextAlignMissing::class);
        $test = self::$columnInstance;
        $this->assertFalse($test->hasTextAlign());
        $test->setTextAlign('random');
        $this->assertFalse($test->hasTextAlign());
        $this->assertSame('random',$test->getTextAlign());
    }

}