<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnCrypt\Base\Domain\Enums\HashAlgoEnum;
use ZnSandbox\Sandbox\Apache\Domain\Entities\ServerEntity;
use ZnSandbox\Sandbox\Apache\Domain\Helpers\ConfParser;

class ServerRepository
{

    private $directory;
    private $hostsRepository;

    public function __construct(string $directory, HostsRepository $hostsRepository)
    {
        $this->directory = $directory;
        $this->hostsRepository = $hostsRepository;
    }

    public function findOneByName(string $name)
    {
        $collection = $this->getIndexedCollection();
        if (!$collection->has($name)) {
            throw new NotFoundException('Server not found!');
        }
        return $collection->get($name);
    }

    /**
     * @return Enumerable | ServerEntity[]
     */
    private function getIndexedCollection(): Enumerable
    {
        $commonTagCollection = ConfParser::readServerConfig($this->directory);
        $commonTagCollection = ArrayHelper::index($commonTagCollection, 'config.ServerName');
        /** @var Enumerable | ServerEntity[] $collection */
        $collection = CollectionHelper::create(ServerEntity::class, $commonTagCollection);
        foreach ($collection as $serverEntity) {
            try {
                $serverEntity->setHosts($this->hostsRepository->findOneByName($serverEntity->getServerName()));
            } catch (NotFoundException $e) {
            }
        }
        return $collection;
    }

    function all(): array
    {
        $commonTagCollection = $this->getIndexedCollection();
        $links = [];
        foreach ($commonTagCollection as $tagEntity) {
            if ($tagEntity->getTagName() == 'VirtualHost' && !empty($tagEntity->getServerName())) {
                $hostName = $tagEntity->getServerName();
                $documentRoot = $tagEntity->getDocumentRoot();
                $hostArray = explode('.', $hostName);
                $categoryName = ArrayHelper::last($hostArray);
                $categoryHash = hash(HashAlgoEnum::CRC32B, $categoryName);

                /*$entity = new \StdClass();
                $entity->title = $categoryName;
                $entity->items = [
                    'server' => $tagEntity,
                ];
                $links[$categoryHash] = $entity;*/

                $links[$categoryHash]['title'] = ($categoryName);
                $links[$categoryHash]['items'][] = [
                    'server' => $tagEntity,
//                    'name' => $hostName,
//                    'url' => "http://{$hostName}",
//                    'title' => $hostName,
//                    'description' => $this->getTitleFromReadme($documentRoot) ?: $this->getTitleFromReadme(FileHelper::up($documentRoot)) ?: $this->getTitleFromReadme(FileHelper::up($documentRoot, 2)),
//                    'category_name' => $categoryName,
//                    'directory_exists' => file_exists(realpath($documentRoot)) ? true : false,
//                    'htaccess_exists' => file_exists(realpath($documentRoot) . '/' . '.htaccess') ? true : false,
                ];
            }
        }
        return $links;
    }

    function all2(): Enumerable
    {
        return $this->getIndexedCollection();
    }

    private function getTitleFromReadme(string $documentRoot): string
    {
        $readmeMd = $documentRoot . '/README.md';
        $readmeMdTitle = '';
        if (file_exists($readmeMd)) {
            $readmeMdLines = file($readmeMd);
            $readmeMdTitle = ltrim($readmeMdLines[0], ' #');
            $readmeMdTitle = trim($readmeMdTitle);
        }
        return $readmeMdTitle;
    }

}
