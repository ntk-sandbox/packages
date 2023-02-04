<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;

class I18nType extends ArrayType
{

    public function isMatch(string $attributeName): bool
    {
        return TypeAttributeHelper::isMatchSuffix($attributeName, '_i18n');
    }
}
