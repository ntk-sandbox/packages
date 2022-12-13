<?php

namespace ZnKaz\Eds\Domain\Services;

use phpseclib\File\X509;
use phpseclib\Math\BigInteger;
use ZnDomain\Entity\Exceptions\AlreadyExistsException;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnKaz\Eds\Domain\Entities\HostEntity;
use ZnKaz\Eds\Domain\Entities\LogEntity;
use ZnKaz\Eds\Domain\Interfaces\Services\CrlServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnKaz\Eds\Domain\Interfaces\Repositories\CrlRepositoryInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnKaz\Eds\Domain\Entities\CrlEntity;

/**
 * @method CrlRepositoryInterface getRepository()
 */
class CrlService extends BaseCrudService implements CrlServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return CrlEntity::class;
    }

    private function loadFromHost(HostEntity $hostEntity) {
        /** @var HostEntity $hostEntity */
        $hostEntity = $this->getEntityManager()->getRepository(HostEntity::class)->findOneById($hostId);
        $binary = file_get_contents($hostEntity->getCrlUrl());
        $x509 = new X509();
        $crl = $x509->loadCRL($binary);
    }

    public function refreshCountByHostId(int $hostId) : int
    {

        
        dd($hostEntity);
        return count($crl['tbsCertList']['revokedCertificates']);
    }
    
    public function refreshByHostId(int $hostId) : LogEntity
    {
        /** @var HostEntity $hostEntity */
        $hostEntity = $this->getEntityManager()->getRepository(HostEntity::class)->findOneById($hostId);
        $binary = file_get_contents($hostEntity->getCrlUrl());
        $x509 = new X509();
        $crl = $x509->loadCRL($binary);
//        $this->alertInfo('Count revoked certificates: ' . count($crl['tbsCertList']['revokedCertificates']));
//        $this->printHeader('First Certificate');

        $existed = 0;
        $created = 0;
        foreach ($crl['tbsCertList']['revokedCertificates'] as $cert) {
            /** @var BigInteger $bigInteger */
            $bigInteger = $cert['userCertificate'];
            $revocedAt = $cert['revocationDate']['utcTime'];

            $crlEntity = new CrlEntity();
            $crlEntity->setHostId(1);
            $crlEntity->setKey($bigInteger->toHex());
            $crlEntity->setRevokedAt(new \DateTime($revocedAt));

            try {
                $this->create(EntityHelper::toArray($crlEntity));
                $created++;
            } catch (AlreadyExistsException $e) {
                $existed++;
            } catch (UnprocessibleEntityException $e) {
                $existed++;
            }
        }
        
        $logEntity = new LogEntity();
        $logEntity->setHostId($hostId);
        $logEntity->setCreatedCount($created);
        $this->getEntityManager()->persist($logEntity);
        
        return $logEntity;
    }
}
