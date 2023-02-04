<?php

namespace Untek\User\Authentication\Domain\Interfaces\Services;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\User\Authentication\Domain\Forms\AuthForm;

interface AuthServiceInterface
{

    /**
     * @return IdentityEntityInterface
     * @throws AuthenticationException
     */
//    public function getIdentity(): ?IdentityEntityInterface;
//    public function setIdentity(IdentityEntityInterface $identityEntity);
    //public function authenticationByForm(LoginForm $loginForm);

    /*
     * @param string $token
     * @param string|null $authenticatorClassName
     * @return mixed
     *
     * @deprecated
     * @see ApiTokenUserProvider
     */
//    public function authenticationByToken(string $token, string $authenticatorClassName = null);
    public function tokenByForm(AuthForm $form);

}
