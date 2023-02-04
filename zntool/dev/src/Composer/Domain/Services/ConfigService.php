<?php

namespace Untek\Tool\Dev\Composer\Domain\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Lib\Components\Store\StoreFile;
use Untek\Tool\Dev\Composer\Domain\Interfaces\Repositories\ConfigRepositoryInterface;
use Untek\Tool\Dev\Composer\Domain\Interfaces\Services\ConfigServiceInterface;
use Untek\Tool\Package\Domain\Entities\ConfigEntity;
use Untek\Tool\Package\Domain\Entities\PackageEntity;
use Untek\Tool\Package\Domain\Interfaces\Repositories\PackageRepositoryInterface;

class ConfigService extends BaseCrudService implements ConfigServiceInterface
{

    private $packageRepository;

    public function __construct(ConfigRepositoryInterface $repository, PackageRepositoryInterface $packageRepository)
    {
        $this->setRepository($repository);
        $this->packageRepository = $packageRepository;
    }

    public function findAll(Query $query = null): Enumerable
    {
        /** @var \Untek\Core\Collection\Interfaces\Enumerable | PackageEntity[] $packageCollection */
        $packageCollection = $this->packageRepository->findAll();
        $configCollection = new Collection();
        foreach ($packageCollection as $packageEntity) {
            $composerConfigFile = $packageEntity->getDirectory() . '/composer.json';
            $composerConfigStore = new StoreFile($composerConfigFile);
            $composerConfig = $composerConfigStore->load();
            $confiEntity = new ConfigEntity;
            $confiEntity->setId($packageEntity->getId());
            $confiEntity->setConfig($composerConfig);
            $confiEntity->setPackage($packageEntity);
            //EntityHelper::setAttributes($confiEntity, ComposerConfigMapper::arrayToEntity($composerConfig));
            $configCollection->add($confiEntity);
        }
        return $configCollection;
    }

    public function allWithThirdParty(Query $query = null)
    {
        /** @var \Untek\Core\Collection\Interfaces\Enumerable | PackageEntity[] $packageCollection */
        $packageCollection = $this->packageRepository->allWithThirdParty();
        //dd($packageCollection);
        $configCollection = new Collection();
        foreach ($packageCollection as $packageEntity) {
            $composerConfigFile = $packageEntity->getDirectory() . '/composer.json';
            $composerConfigStore = new StoreFile($composerConfigFile);
            $composerConfig = $composerConfigStore->load();
            $confiEntity = new ConfigEntity;
            $confiEntity->setId($packageEntity->getId());
            $confiEntity->setConfig($composerConfig);
            $confiEntity->setPackage($packageEntity);
            //EntityHelper::setAttributes($confiEntity, ComposerConfigMapper::arrayToEntity($composerConfig));
            $configCollection->add($confiEntity);
        }
        return $configCollection;
    }

}
