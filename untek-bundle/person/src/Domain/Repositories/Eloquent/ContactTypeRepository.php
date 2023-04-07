<?php

namespace Untek\Bundle\Person\Domain\Repositories\Eloquent;

use Untek\Bundle\Person\Domain\Entities\ContactTypeEntity;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Model\Repository\Mappers\JsonMapper;

class ContactTypeRepository extends BaseEloquentCrudRepository implements ContactTypeRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_contact_type';
    }

    public function getEntityClass(): string
    {
        return ContactTypeEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['title_i18n']),
        ];
    }

}
