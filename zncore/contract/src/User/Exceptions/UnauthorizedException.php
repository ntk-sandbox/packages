<?php

namespace ZnCore\Contract\User\Exceptions;

//use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Exception;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use ZnCore\Code\Helpers\DeprecateHelper;

DeprecateHelper::hardThrow();

/**
 * Не аутентифицированный пользователь
 */
class UnauthorizedException extends AuthenticationException
{

}
