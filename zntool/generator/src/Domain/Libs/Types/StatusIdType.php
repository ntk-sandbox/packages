<?php

namespace Untek\Tool\Generator\Domain\Libs\Types;

use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;

class StatusIdType extends IntType
{

    public function isMatch(string $attributeName): bool
    {
        return $attributeName == 'status_id';
    }
}
