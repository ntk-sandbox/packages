<?php

namespace Untek\Framework\Rpc\Symfony4\Web\Libs;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Crypt\Base\Domain\Enums\EncodingEnum;
use Untek\Crypt\Base\Domain\Enums\HashAlgoEnum;
use Untek\Crypt\Base\Domain\Enums\OpenSslAlgoEnum;
use Untek\Crypt\Pki\Domain\Libs\Rsa\RsaStoreInterface;
use Untek\Crypt\Pki\JsonDSig\Domain\Entities\SignatureEntity;
use Untek\Crypt\Pki\JsonDSig\Domain\Libs\OpenSsl\OpenSslSignature;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;

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
