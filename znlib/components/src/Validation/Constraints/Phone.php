<?php

namespace ZnLib\Components\Validation\Constraints;

use ZnDomain\Validator\Constraints\BaseRegex;
use ZnLib\Components\Regexp\Enums\RegexpPatternEnum;

class Phone extends BaseRegex
{

    public function regexPattern(): string
    {
        return RegexpPatternEnum::PHONE_REQUIRED;
    }
}
