<?php

namespace ZnUser\Authentication\Symfony4\Components\Core;

use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\NullToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Security extends \Symfony\Component\Security\Core\Security
{

    private $token;

    public function __construct(ContainerInterface $container, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($container);
//        $tokenStorage->setToken(new NullToken());
    }
}
