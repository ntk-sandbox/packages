<?php

namespace Untek\Bundle\Storage\Domain\Services;

use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Services\FileServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

class FileService extends BaseCrudService implements FileServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass(): string
    {
        return FileEntity::class;
    }

    public function deleteById($id)
    {
        $fileEntity = $this->findOneById($id);
        parent::deleteById($id);
        unlink($fileEntity->getFileName());
    }
}
