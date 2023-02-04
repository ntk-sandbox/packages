<?php

namespace Untek\Bundle\Storage\Domain\Services;

use Untek\Bundle\Storage\Domain\Entities\FileEntity;
use Untek\Bundle\Storage\Domain\Interfaces\Services\FileServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;

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
