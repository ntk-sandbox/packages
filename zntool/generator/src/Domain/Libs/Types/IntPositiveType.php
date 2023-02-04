<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;
use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;

class IntPositiveType extends IntType
{

    public function isMatch(string $attributeName): bool
    {
        return TypeAttributeHelper::isMatchSuffix($attributeName, '_id') || $attributeName == 'id';
    }
}
