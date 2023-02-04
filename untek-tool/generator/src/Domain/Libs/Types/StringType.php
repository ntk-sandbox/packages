<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;
use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;

class StringType extends BaseType
{

    public function getType(): string {
        return 'string';
    }

    public function isMatch(string $attributeName): bool
    {
        return
            $this->matchSuffixOrEqual($attributeName, 'title') ||
            $this->matchSuffixOrEqual($attributeName, 'name');
    }
}
