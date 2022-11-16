<?php

namespace ZnUser\Authentication\Domain\Services;

use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnUser\Authentication\Domain\Entities\TokenEntity;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;
use ZnUser\Authentication\Domain\Interfaces\AuthorizationTokenGeneratorInterface;
use ZnUser\Authentication\Domain\Interfaces\Repositories\TokenRepositoryInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface;

class BearerTokenService implements TokenServiceInterface
{

    private $tokenRepository;
    private $authorizationTokenGenerator;

    public function __construct(
        TokenRepositoryInterface $tokenRepository,
        AuthorizationTokenGeneratorInterface $authorizationTokenGenerator
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->authorizationTokenGenerator = $authorizationTokenGenerator;
    }

    public function getTokenByIdentity(IdentityEntityInterface $identityEntity): TokenValueEntity
    {
        $token = $this->authorizationTokenGenerator->generateToken();

        try {
            $tokenEntity = $this->tokenRepository->findOneByValue($token, 'bearer');
        } catch (NotFoundException $exception) {
            $tokenEntity = new TokenEntity();
            $tokenEntity->setIdentityId($identityEntity->getId());
            $tokenEntity->setType('bearer');
            $tokenEntity->setValue($token);
            $this->tokenRepository->create($tokenEntity);
        }
        $resultTokenEntity = new TokenValueEntity($token, 'bearer', $identityEntity->getId());
        $resultTokenEntity->setId($tokenEntity->getId());
//        $resultTokenEntity->setIdentity($identityEntity);
        return $resultTokenEntity;
    }

    public function getIdentityIdByToken(string $token): int
    {
        list($tokenType, $tokenValue) = explode(' ', $token);
        $tokenEntity = $this->tokenRepository->findOneByValue($tokenValue, 'bearer');
        return $tokenEntity->getIdentityId();
    }

//    private function generateToken(): string
//    {
//        return $this->authorizationTokenGenerator->generateToken();
//
//        // todo: отделить генератор пароля в отдельный класс
//        /*$random = new RandomString();
//        $random->setLength($this->tokenLength);
////        $random->addCharactersAll();
//        $random->addCharactersLower();
//        $random->addCharactersUpper();
//        $random->addCharactersNumber();
//        $random->addCustomChar('!#$%&()*+,-./:;<=>?@[]^_`{|}~');
//        return $random->generateString();*/
//    }
}
