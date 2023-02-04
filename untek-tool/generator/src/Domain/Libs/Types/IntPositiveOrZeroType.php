<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;
use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;

class IntPositiveOrZeroType extends IntType
{

    public function isMatch(string $attributeName): bool
    {
        return
            TypeAttributeHelper::isMatchSuffix($attributeName, '_count') ||
            $attributeName == 'count' ||
            TypeAttributeHelper::isMatchSuffix($attributeName, '_size') ||
            $attributeName == 'size';
    }
}
