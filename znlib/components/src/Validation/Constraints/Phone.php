<?php

namespace Untek\Lib\Components\Validation\Constraints;

use Untek\Domain\Validator\Constraints\BaseRegex;
use Untek\Lib\Components\Regexp\Enums\RegexpPatternEnum;

class Phone extends BaseRegex
{

    public function regexPattern(): string
    {
        return RegexpPatternEnum::PHONE_REQUIRED;
    }
}
