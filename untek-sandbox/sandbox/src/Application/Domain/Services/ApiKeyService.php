<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Services;

use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Services\ApiKeyServiceInterface;
use Untek\Core\Text\Libs\RandomString;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApiKeyRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApiKeyEntity;

/**
 * @method
 * ApiKeyRepositoryInterface getRepository()
 */
class ApiKeyService extends BaseCrudService implements ApiKeyServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ApiKeyEntity::class;
    }
    public function create($data): EntityIdInterface
    {
        $generator = new RandomString();
        $generator->addCharactersAll();
        $generator->setLength(32);

        $data['value'] = $generator->generateString();
//        dd($attributes);
        return parent::create($data);
    }
}
