<?php

namespace ZnCore\Contract\User\Exceptions;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Не достаточно полномочий
 */
class ForbiddenException extends AccessDeniedException
{

}
