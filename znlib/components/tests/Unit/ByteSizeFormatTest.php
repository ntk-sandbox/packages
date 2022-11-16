<?php

namespace ZnLib\Components\Tests\Unit;

use ZnLib\Components\Byte\Helpers\ByteSizeFormatHelper;
use ZnTool\Test\Asserts\DataAssert;
use ZnTool\Test\Asserts\DataTestCase;

final class ByteSizeFormatTest extends DataTestCase
{

    public function testSize()
    {
        $size = ByteSizeFormatHelper::sizeFormat(123);
        $this->assertEquals('123 B', $size);

        $size = ByteSizeFormatHelper::sizeFormat(1022475);
        $this->assertEquals('998.51 KB', $size);

        $size = ByteSizeFormatHelper::sizeFormat(56461789651);
        $this->assertEquals('52.58 GB', $size);

        $size = ByteSizeFormatHelper::sizeFormat(5646178965111111);
        $this->assertEquals('5.01 PB', $size);

        $size = ByteSizeFormatHelper::sizeFormat(5999999999999999999);
        $this->assertEquals('5.2 EB', $size);
    }
}
