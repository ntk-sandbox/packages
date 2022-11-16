<?php

namespace ZnSandbox\Sandbox\Application\Domain\Services;

use DateTime;
use phpseclib\File\X509;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnCrypt\Base\Domain\Exceptions\CertificateExpiredException;
use ZnCrypt\Base\Domain\Exceptions\FailCertificateSignatureException;
use ZnCrypt\Pki\X509\Domain\Helpers\X509Helper;
use ZnCrypt\Pki\XmlDSig\Domain\Entities\KeyEntity;
use ZnCrypt\Pki\XmlDSig\Domain\Libs\Signature;
use ZnSandbox\Sandbox\Application\Domain\Entities\EdsEntity;
use ZnSandbox\Sandbox\Application\Domain\Interfaces\Repositories\EdsRepositoryInterface;
use ZnSandbox\Sandbox\Application\Domain\Interfaces\Services\EdsServiceInterface;

/**
 * @method EdsRepositoryInterface getRepository()
 */
class EdsService extends BaseCrudService implements EdsServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return EdsEntity::class;
    }

    public function create($data): EntityIdInterface
    {
        $caKeyEntity = $this->loadCa();

        //dd($attributes['certificateRequest']);

        $certificateRequestPem = $data['certificateRequest'];

        //dd($certificateRequestPem);

        $x509 = new X509();
        $x509->loadCA($caKeyEntity->getCertificate());
//       $csr = $x509->loadCSR($certificateRequestPem);
//       dd($csr);
//       // $privKey = openssl_pkey_get_private($caKeyEntity->getPrivateKey(), $caKeyEntity->getPrivateKeyPassword());
//
//        $privKey = new RSA();
//        //extract($privKey->createKey());
//        $privKey->loadKey($caKeyEntity->getPrivateKey());
//
//        $x509->setPrivateKey($privKey);
//        $csr = $x509->signCSR();
//        $csrPem = $x509->saveCSR($csr);
//
//        dd($csrPem);
//
//        dd($x509->validateSignature() ? 'valid' : 'invalid');
//
//        dd($csr);

        $certificatePem = $this->generateCertificateByCsr($certificateRequestPem);


//        dd($certificatePem);
        $verify = new Signature();
        $verify->setRootCa($caKeyEntity->getCertificate());
        $verifyEntity = $verify->verifyCertificate($certificatePem);

        //dump($verifyEntity);

        /*if (!$verifyEntity->isDigest()) {
            throw new InvalidDigestException();
        }

        if (!$verifyEntity->isSignature()) {
            throw new FailSignatureException();
        }*/

        if (!$verifyEntity->isCertificateSignature()) {
            throw new FailCertificateSignatureException();
        }

        if (!$verifyEntity->isCertificateDate()) {
            throw new CertificateExpiredException();
        }

        // dd($verifyEntity);

        //dd($_ENV['PKI_CA_FILE']);

        /*$caPem = FileHelper::load($_ENV['PKI_CA_FILE']);
        $x509 = new X509();
        $x509->loadCA($caPem);*/
        $certArray = $x509->loadX509($certificatePem);

        $createdAt = new DateTime($certArray['tbsCertificate']['validity']['notBefore']['utcTime']);
        $expiredAt = new DateTime($certArray['tbsCertificate']['validity']['notAfter']['utcTime']);

        //dd($d);


//        $certificateEntity = X509Helper::certArrayToEntity($certArray);
//        dd($certificateEntity);
        $subject = X509Helper::getAssoc1($certArray['tbsCertificate']['subject']['rdnSequence']);
        // $extensions = X509Helper::getAssocExt($certArray['tbsCertificate']['extensions']);
        //dd($subject);

        /** @var EdsEntity $edsEntity */
        $edsEntity = $this->createEntity();
        $edsEntity->setApplicationId(1);
        $edsEntity->setCertificate($certificatePem);
        $edsEntity->setCertificateRequest($certificateRequestPem);
        $edsEntity->setFingerprint($verifyEntity->getFingerprint()->getSha256());
        $edsEntity->setSubject(json_encode($subject, JSON_UNESCAPED_UNICODE));
        $edsEntity->setCreatedAt($createdAt);
        $edsEntity->setExpiredAt($expiredAt);

        $this->getEntityManager()->persist($edsEntity);

        //dd($edsEntity);

        return $edsEntity;
    }

    protected function loadCa(): KeyEntity
    {
        $caPem = FileStorageHelper::load($_ENV['PKI_CA_FILE']);
        $caPrivateKeyPassword = FileStorageHelper::load($_ENV['PKI_CA_PRIVATE_KEY_PASSWORD_FILE']);
        $privateKeyPem = FileStorageHelper::load($_ENV['PKI_CA_PRIVATE_KEY_FILE']);
        $caKeyEntity = new KeyEntity();
        $caKeyEntity->setCertificate($caPem);
        $caKeyEntity->setPrivateKey($privateKeyPem);
        $caKeyEntity->setPrivateKeyPassword($caPrivateKeyPassword);
        return $caKeyEntity;
    }

    private function generateCertificateByCsr($certificateRequestPem)
    {
        $caKeyEntity = $this->loadCa();

        $privateKeyResource = [$caKeyEntity->getPrivateKey(), $caKeyEntity->getPrivateKeyPassword()];
        $certificateResource = openssl_csr_sign($certificateRequestPem, $caKeyEntity->getCertificate(), $privateKeyResource, $days = 365 * 10, array('digest_alg' => 'sha256'), 1234567890);
        openssl_x509_export($certificateResource, $certificatePem);
        return $certificatePem;
    }
}
