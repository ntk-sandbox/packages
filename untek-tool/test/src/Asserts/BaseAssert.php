<?php

namespace Untek\Tool\Test\Asserts;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Tool\Test\Base\BaseTestCase;
use Untek\Tool\Test\Helpers\RestHelper;

abstract class BaseAssert extends BaseTestCase
{

    public function assertItemsByAttribute(array $values, string $attributeName, array $collection)
    {
        $actualIds = ArrayHelper::getColumn($collection, $attributeName);
        sort($values);
        sort($actualIds);
        $this->assertEquals($values, $actualIds);
    }
}
