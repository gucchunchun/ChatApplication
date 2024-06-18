<?php

namespace Tests\Unit\Utilities;

use PHPUnit\Framework\TestCase;
use App\Utilities\StringConverter;

class StringConverterTest extends TestCase
{

    public function test_1_1(): void
    {
        $word = 'hoge';

        $result = StringConverter::camelToSnake($word);

        $this->assertEquals('hoge', $result);
    }
    public function test_2_1(): void
    {
        $word = 'hogeHoge';

        $result = StringConverter::camelToSnake($word);

        $this->assertEquals('hoge_hoge', $result);
    }
    public function test_3_1(): void
    {
        $word = 'hogeHogeHoge';

        $result = StringConverter::camelToSnake($word);

        $this->assertEquals('hoge_hoge_hoge', $result);
    }
}
