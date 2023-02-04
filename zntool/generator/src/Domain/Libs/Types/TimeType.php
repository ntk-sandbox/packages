<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;
use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;

class TimeType extends BaseType
{

    public function getType(): string {
        return 'time';
    }

    public function isMatch(string $attributeName): bool
    {
        return TypeAttributeHelper::isMatchSuffix($attributeName, '_at');
    }
}
