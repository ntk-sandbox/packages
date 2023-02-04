<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;

class TextType extends StringType
{

    public function isMatch(string $attributeName): bool
    {
        return
            $this->matchSuffixOrEqual($attributeName, 'text') ||
            $this->matchSuffixOrEqual($attributeName, 'description') ||
            $this->matchSuffixOrEqual($attributeName, 'content');
    }
}
