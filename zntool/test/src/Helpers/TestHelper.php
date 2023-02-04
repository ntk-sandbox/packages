<?php

namespace Untek\Tool\Test\Helpers;

class TestHelper
{

    public static function isRewriteData(): bool
    {
        return boolval(getenv('TEST_IS_REWRITE_DATA'));
    }
}
