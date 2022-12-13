<?php

namespace ZnCore\Contract\User\Exceptions;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZnCore\Code\Helpers\DeprecateHelper;

DeprecateHelper::hardThrow();

/**
 * Не достаточно полномочий
 */
class ForbiddenException extends AccessDeniedException
{

}
