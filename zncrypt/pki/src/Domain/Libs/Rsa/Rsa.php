<?php

namespace ZnCrypt\Pki\Domain\Libs\Rsa;

use ZnCrypt\Pki\Domain\Entities\RsaKeyEntity;
use ZnCrypt\Pki\Domain\Entities\SignatureEntity;
use ZnCrypt\Base\Domain\Enums\HashAlgoEnum;
use ZnCrypt\Pki\Domain\Enums\RsaKeyFormatEnum;
use ZnCrypt\Base\Domain\Libs\Encoders\EncoderInterface;
use ZnCrypt\Pki\Domain\Helpers\RsaKeyHelper;

class Rsa implements EncoderInterface
{

    private $store;

    public function __construct(RsaStoreInterface $store)
    {
        $this->store = $store;
    }

    public function getPublicKey()
    {
        return $this->store->getPublicKey();
    }

    public function getCertificate(): RsaKeyEntity
    {
        $pem = $this->store->getCertificate();
        $json = RsaKeyHelper::pemToBin($pem);
        $key = new RsaKeyEntity(RsaKeyEntity::CERTIFICATE, $json);
        return $key;
    }

    public function encode($data)
    {
        $pKey = openssl_pkey_get_public($this->store->getPublicKey());
        $encrypted = "";
        openssl_public_encrypt($data, $encrypted, $pKey);
        return base64_encode($encrypted);
    }

    public function decode($encrypted)
    {
        $ogp = openssl_get_privatekey($this->store->getPrivateKey());
        $binEncyptedData = base64_decode($encrypted);
        $isSuccess = @openssl_private_decrypt($binEncyptedData, $out, $ogp);
        if(! $isSuccess) {
            throw new \Exception('Decrypt error');
        }
        return $out;
    }

    public function sign(string $data, string $algoName = HashAlgoEnum::SHA256): SignatureEntity
    {
        $p = openssl_pkey_get_private($this->store->getPrivateKey(), $this->store->getPrivateKeyPassword());
        //dd($p);
        openssl_sign($data, $signature, $p, HashAlgoEnum::nameToOpenSsl($algoName));
        openssl_free_key($p);
        $signatureEntity = new SignatureEntity;
        $signatureEntity->setSignatureBin($signature);
        $signatureEntity->setAlgorithm($algoName);
        return $signatureEntity;
    }

    public function verify($data, SignatureEntity $signatureEntity): bool
    {
        $algo = HashAlgoEnum::nameToOpenSsl($signatureEntity->getAlgorithm());
        $p = openssl_pkey_get_public($this->store->getPublicKey(RsaKeyFormatEnum::PEM));
        $isVerify = openssl_verify($data, $signatureEntity->getSignatureBin(), $p, $algo);
        openssl_free_key($p);
        return $isVerify;
    }






    function privateKeyEncrypt($privateKey, $content)
    {
        $piKey = openssl_pkey_get_private($privateKey);
        $encrypted = "";
        openssl_private_encrypt($content, $encrypted, $piKey);
        return base64_encode($encrypted);
    }
//rsa????????????
    function publicKeyDecrypt($publicKey, $content)
    {
        $pKey = openssl_pkey_get_public($publicKey);
        $decrypted = "";
        openssl_public_decrypt($content, $decrypted, $pKey);
        return $decrypted;
    }
//rsa????????????
    function publicKeyEncrypt($publicKey, $content)
    {
        $pKey = openssl_pkey_get_public($publicKey);
        $encrypted = "";
        openssl_public_encrypt($content, $encrypted, $pKey);
        return base64_encode($encrypted);
    }
//rsa????????????
    function privateKeyDecrypt($privateKey, $content)
    {
        $pKey = openssl_pkey_get_private($privateKey);
        $decrypted = "";
        openssl_private_decrypt($content, $decrypted, $pKey);
        return $decrypted;
    }
}
