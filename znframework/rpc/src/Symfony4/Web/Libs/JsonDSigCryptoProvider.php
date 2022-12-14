<?php

namespace ZnFramework\Rpc\Symfony4\Web\Libs;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnCrypt\Base\Domain\Enums\EncodingEnum;
use ZnCrypt\Base\Domain\Enums\HashAlgoEnum;
use ZnCrypt\Base\Domain\Enums\OpenSslAlgoEnum;
use ZnCrypt\Pki\Domain\Libs\Rsa\RsaStoreInterface;
use ZnCrypt\Pki\JsonDSig\Domain\Entities\SignatureEntity;
use ZnCrypt\Pki\JsonDSig\Domain\Libs\OpenSsl\OpenSslSignature;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;

/**
 * Стратегия криптопровайдера, выполяющая контроль ЭПЦ, наподобие XMLDSig.
 *
 * Используется при включении контроля ЭЦП запросов и ответов по схеме, схожей с XMLDSig.
 */
class JsonDSigCryptoProvider implements CryptoProviderInterface
{

    private $keyStoreUser;
    private $keyCaStore;

    public function __construct(RsaStoreInterface $keyStoreUser, RsaStoreInterface $keyCaStore)
    {
        $this->keyStoreUser = $keyStoreUser;
        $this->keyCaStore = $keyCaStore;
    }

    public function signRequest(RpcRequestEntity $requestEntity): void
    {
        $requestArray = EntityHelper::toArray($requestEntity);
        $signatureEntity = new SignatureEntity();
        $signatureEntity->setDigestMethod(HashAlgoEnum::SHA256);
        $signatureEntity->setDigestFormat(EncodingEnum::BASE64);
        $signatureEntity->setSignatureMethod(OpenSslAlgoEnum::SHA256);
        $signatureEntity->setSignatureFormat(EncodingEnum::BASE64);
        $openSslSignature = $this->getOpenSslSignature();
        $openSslSignature->sign($requestArray, $signatureEntity);
        $requestEntity->addMeta('signature', EntityHelper::toArray($signatureEntity));
    }

    public function verifyRequest(RpcRequestEntity $requestEntity): void
    {
        $requestArray = EntityHelper::toArray($requestEntity);
        $signatureEntity = new SignatureEntity();
        PropertyHelper::setAttributes($signatureEntity, $requestEntity->getMetaItem('signature'));
        unset($requestArray['meta']['signature']);
        $openSslSignature = $this->getOpenSslSignature();
        $openSslSignature->verify($requestArray, $signatureEntity);
    }

    public function signResponse(RpcResponseEntity $responseEntity): void
    {
        $responseArray = EntityHelper::toArray($responseEntity);
        $signatureEntity = new SignatureEntity();
        $signatureEntity->setDigestMethod(HashAlgoEnum::SHA256);
        $signatureEntity->setDigestFormat(EncodingEnum::BASE64);
        $signatureEntity->setSignatureMethod(OpenSslAlgoEnum::SHA256);
        $signatureEntity->setSignatureFormat(EncodingEnum::BASE64);
        $openSslSignature = $this->getOpenSslSignature();
        $openSslSignature->sign($responseArray, $signatureEntity);
        $responseEntity->addMeta('signature', EntityHelper::toArray($signatureEntity));
    }

    public function verifyResponse(RpcResponseEntity $responseEntity): void
    {
        $responseArray = EntityHelper::toArray($responseEntity);
        $signatureEntity = new SignatureEntity();
        PropertyHelper::setAttributes($signatureEntity, $responseEntity->getMetaItem('signature'));
        unset($responseArray['meta']['signature']);
        $openSslSignature = $this->getOpenSslSignature();
        $openSslSignature->verify($responseArray, $signatureEntity);
    }

    private function getOpenSslSignature(): OpenSslSignature
    {
        $openSslSignature = new OpenSslSignature($this->keyStoreUser);
        $openSslSignature->loadCA($this->keyCaStore->getCertificate());
        return $openSslSignature;
    }
}
