<?php

use Symfony\Component\PasswordHasher\Hasher\NativePasswordHasher;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use ZnUser\Authentication\Domain\Interfaces\AuthorizationTokenGeneratorInterface;
use ZnUser\Authentication\Domain\Libs\SafeUriAuthorizationTokenGenerator;

return [
    'definitions' => [

    ],
    'singletons' => [
        PasswordHasherInterface::class => NativePasswordHasher::class,
        Security::class => \ZnUser\Authentication\Symfony4\Components\Core\Security::class,
        TokenStorageInterface::class => TokenStorage::class,
        AuthorizationTokenGeneratorInterface::class => SafeUriAuthorizationTokenGenerator::class,

        'ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface' => 'ZnUser\Authentication\Domain\Services\BearerTokenService',
//        'ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface' => 'ZnUser\Authentication\Domain\Services\JwtTokenService',
        'ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface' => 'ZnUser\Authentication\Domain\Services\AuthService',
        'ZnUser\\Authentication\\Domain\\Interfaces\\Services\\ImitationAuthServiceInterface' => 'ZnUser\\Authentication\\Domain\\Services\\ImitationAuthAuthService',
        'ZnUser\Authentication\Domain\Interfaces\Services\CredentialServiceInterface' => 'ZnUser\Authentication\Domain\Services\CredentialService',
        'ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface' => 'ZnUser\Authentication\Domain\Repositories\Eloquent\CredentialRepository',
        'ZnUser\Authentication\Domain\Interfaces\Repositories\TokenRepositoryInterface' => 'ZnUser\Authentication\Domain\Repositories\Eloquent\TokenRepository',
    ],
    /*'entities' => [
        'ZnUser\Authentication\Domain\Entities\CredentialEntity' => 'ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface',
        'ZnUser\Authentication\Domain\Entities\TokenEntity' => 'ZnUser\Authentication\Domain\Interfaces\Repositories\TokenRepositoryInterface',
    ],*/
];
