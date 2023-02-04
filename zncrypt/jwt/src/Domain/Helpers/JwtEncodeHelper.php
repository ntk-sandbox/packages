<?php

namespace Untek\Crypt\Jwt\Domain\Helpers;

use DomainException;
use InvalidArgumentException;
use Untek\Crypt\Base\Domain\Helpers\SafeBase64Helper;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Crypt\Jwt\Domain\Dto\TokenDto;
use Untek\Crypt\Jwt\Domain\Entities\JwtHeaderEntity;
use Untek\Crypt\Jwt\Domain\Entities\JwtProfileEntity;
use Untek\Crypt\Jwt\Domain\Entities\KeyEntity;
use Untek\Crypt\Base\Domain\Enums\EncryptFunctionEnum;
use Untek\Crypt\Jwt\Domain\Enums\EncryptKeyTypeEnum;
use Untek\Crypt\Jwt\Domain\Enums\JwtAlgorithmEnum;
use Untek\Crypt\Jwt\Domain\Exceptions\SignatureInvalidException;
use Untek\Crypt\Jwt\Domain\Strategies\Func\FuncContext;

class JwtEncodeHelper
{

    /**
     * @param string $jwt
     * @return TokenDto
     * @deprecated
     * @see JwtModelHelper::parseToken
     */
    public static function decode(string $jwt): TokenDto
    {
        $tokenDto = JwtModelHelper::parseToken($jwt);
        return $tokenDto;
    }

    public static function verifyTokenDto(TokenDto $tokenDto, JwtProfileEntity $profileEntity)
    {
        JwtModelHelper::validateToken($tokenDto, $profileEntity->allowed_algs);
        JwtModelHelper::verifyTime($tokenDto);
        self::verifySignature($tokenDto, $profileEntity->key);
    }

    public static function encode(array $payload, KeyEntity $keyEntity, JwtHeaderEntity $jwtHeaderEntity = null): string
    {
        $tokenDto = new TokenDto;
        $tokenDto->header_encoded = JwtSegmentHelper::encodeSegment(ArrayHelper::toArray($jwtHeaderEntity));
        $tokenDto->payload_encoded = JwtSegmentHelper::encodeSegment($payload);
        $signature = static::sign($tokenDto, $keyEntity, $jwtHeaderEntity->alg);
        $tokenDto->signature_encoded = SafeBase64Helper::encode($signature);
        return self::buildTokenFromDto($tokenDto);
    }

    private static function buildTokenFromDto(TokenDto $tokenDto, $full = true): string
    {
        $token = $tokenDto->header_encoded . '.' . $tokenDto->payload_encoded;
        if ($full && $tokenDto->signature_encoded) {
            $token .= '.' . $tokenDto->signature_encoded;
        }
        return $token;
    }

    private static function extractKey(KeyEntity $keyEntity, $type = EncryptKeyTypeEnum::PRIVATE)
    {

        $isRsa = $keyEntity->type === OPENSSL_KEYTYPE_RSA;
        if ($isRsa) {
            $key = ArrayHelper::getValue($keyEntity, $type);
        } else {
            $key = ArrayHelper::getValue($keyEntity, EncryptKeyTypeEnum::PRIVATE);
        }

        /*if($keyEntity->type === OPENSSL_KEYTYPE_RSA && ) {
            $key = $keyEntity->public;
        } else {
            $key = $keyEntity->private;
        }*/
        if (empty($key)) {
            throw new InvalidArgumentException('Key may not be empty');
        }
        return $key;
    }

    private static function verifySignature(TokenDto $tokenDto, KeyEntity $keyEntity)
    {
        $isVerified = static::verify($tokenDto, $keyEntity);
        if ( ! $isVerified) {
            throw new SignatureInvalidException('Signature verification failed');
        }
    }

    private static function sign(TokenDto $tokenDto, KeyEntity $keyEntity, $alg = JwtAlgorithmEnum::HS256)
    {
        $key = self::extractKey($keyEntity, EncryptKeyTypeEnum::PRIVATE);
        $msg = self::buildTokenFromDto($tokenDto, false);
        if ( ! JwtAlgorithmEnum::isSupported($alg)) {
            throw new DomainException('Algorithm not supported');
        }
        $algorithm = JwtAlgorithmEnum::getHashAlgorithm($alg);
        $function = self::getFunction($keyEntity->type);
        $loginContext = new FuncContext;
        $loginContext->setStrategyName($function);
        return $loginContext->sign($msg, $algorithm, $key);
    }

    private static function verify(TokenDto $tokenDto, KeyEntity $keyEntity)
    {
        $key = self::extractKey($keyEntity, EncryptKeyTypeEnum::PUBLIC);
        JwtModelHelper::validateKey($tokenDto, $key);
        $msg = self::buildTokenFromDto($tokenDto, false);
        $signature = $tokenDto->signature;
        $alg = $tokenDto->header->alg;
        $algorithm = JwtAlgorithmEnum::getHashAlgorithm($alg);
        $function = self::getFunction($keyEntity->type);
        $loginContext = new FuncContext;
        $loginContext->setStrategyName($function);
        return $loginContext->verify($msg, $algorithm, $key, $signature);
    }

    private static function getFunction(int $type = null): string
    {
        $isRsa = $type === OPENSSL_KEYTYPE_RSA;
        $function = $isRsa ? EncryptFunctionEnum::OPENSSL : EncryptFunctionEnum::HASH_HMAC;
        return $function;
    }

}
