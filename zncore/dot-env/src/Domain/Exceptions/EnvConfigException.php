<?php

namespace ZnCore\DotEnv\Domain\Exceptions;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\Contract\Common\Exceptions\InvalidConfigException;

DeprecateHelper::hardThrow();

class EnvConfigException extends InvalidConfigException
{

}
