<?php

namespace Untek\Framework\Rpc\Domain\Repositories\ConfigManager;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Untek\Lib\Components\Store\StoreFile;
use Untek\Domain\Components\FileRepository\Base\BaseFileCrudRepository;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Framework\Rpc\Domain\Entities\MethodEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Repositories\MethodRepositoryInterface;
use Untek\Core\Arr\Helpers\ArrayHelper;

class MethodRepository extends BaseFileCrudRepository implements MethodRepositoryInterface
{

    const CACHE_KEY = 'rpcMethodCollection';
    
    private $cache;

    public function __construct(EntityManagerInterface $em, AdapterInterface $cache)
    {
        parent::__construct($em);
        $this->cache = $cache;
    }

    public function fileName(): string
    {
//        return __DIR__ . '/../../../../../../../fixtures/rpc_route.php';
    }

    public function getEntityClass() : string
    {
        return MethodEntity::class;
    }

    public function findOneByMethodName(string $method, int $version): MethodEntity
    {
        $query = new Query();
        $query->where('version', $version);
        $query->where('method_name', $method);
        return $this->findOne($query);
    }

    protected function getItems(): array
    {
        $cacheItem = $this->cache->getItem(self::CACHE_KEY);
        if($cacheItem->get() == null) {
            $collection = \Untek\Framework\Rpc\Domain\Helpers\RoutesHelper::getAllRoutes();
            $cacheItem->set($collection);
            $cacheItem->expiresAfter(60);
            $this->cache->save($cacheItem);
        }
        return $cacheItem->get();
    }
}
