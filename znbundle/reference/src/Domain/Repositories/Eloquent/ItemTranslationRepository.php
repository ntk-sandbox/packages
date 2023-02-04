<?php

namespace Untek\Bundle\Reference\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Entities\ItemTranslationEntity;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemTranslationRepositoryInterface;
use Untek\Lib\I18Next\Facades\I18Next;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Database\Eloquent\Domain\Capsule\Manager;

class ItemTranslationRepository extends BaseEloquentCrudRepository implements ItemTranslationRepositoryInterface
{

    protected $tableName = 'reference_item_translation';
    protected $translationService;

    public function getEntityClass(): string
    {
        return ItemTranslationEntity::class;
    }

    public function __construct(EntityManagerInterface $em, Manager $capsule/*, TranslationService $translationService*/)
    {
        parent::__construct($em, $capsule);
        $this->translationService = I18Next::getService();
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $where = new Where('language_code', $this->translationService->getLanguage());
        $query->whereNew($where);
        return $query;
    }
}
