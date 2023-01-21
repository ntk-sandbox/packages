<?php

namespace ZnCore\DotEnv\Domain\Libs\Vlucas;

use Dotenv\Dotenv;
use Dotenv\Loader\Loader;
use Dotenv\Parser\Entry;
use Dotenv\Parser\Parser;
use Dotenv\Store\StringStore;
use ZnCore\Code\Exceptions\NotFoundDependencyException;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnCore\DotEnv\Domain\Interfaces\BootstrapInterface;
use ZnLib\Components\Store\StoreFile;

/**
 * Загрузчик переменных окружения
 */
class VlucasBootstrap implements BootstrapInterface
{

    public function __construct(protected string $mode, protected string $rootDirectory)
    {
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @return string
     */
    public function getRootDirectory(): string
    {
        return $this->rootDirectory;
    }

    public function loadFromPath(
        string $basePath = null,
        array $names = null
    ): void {
        $this->checkAll();
        $this->bootVlucasDotenvFromFile($basePath, $names);
    }

    public function loadFromArray(array $env): void
    {
        $this->checkAll();
        $this->bootVlucasDotenvFromArray($env);
    }

    public function loadFromContent(string $content): void
    {
        $this->checkAll();

        /*$this->saveContentsToPhpFile($contents)*/

        $repository = $this->createRepository();
        $dotenv = new \Dotenv\Dotenv(new StringStore($content), new Parser(), new Loader(), $repository);
        $dotenv->load();
    }

    protected function bootVlucasDotenvFromArray(array $env): void
    {
        $repository = $this->createRepository();
        $rr = [];
        foreach ($env as $name => $value) {
            $v = \Dotenv\Parser\Value::blank();
            $v = $v->append($value, true);
            $rr[] = new Entry($name, $v);
        }
        (new Loader())->load($repository, $rr);
    }

    protected function bootVlucasDotenvFromFile(
        string $basePath,
        array $names = null
    ): void {
        $repository = $this->createRepository();
        $dotenv = \Dotenv\Dotenv::create($repository, $basePath, $names, false);
        $dotenv->load();
    }

    protected function checkAll()
    {
        if ($this->checkInit()) {
            return;
        }
        $this->checkVlucasDotenvPackage();
    }

    /**
     * Проверка повтроной инициализации
     *
     * @return bool
     */
    protected function checkInit(): bool
    {
        return getenv('ROOT_DIRECTORY') != null;

//        $isInited = $this->inited;
//        $this->inited = true;
//        return $isInited;
    }

    /**
     * Проверка установки пакета 'vlucas/phpdotenv'
     *
     * @throws NotFoundDependencyException
     */
    protected function checkVlucasDotenvPackage(): void
    {
        ComposerHelper::requireAssert(Dotenv::class, 'vlucas/phpdotenv', "5.*");
    }

    protected function createRepository(): \Dotenv\Repository\RepositoryInterface
    {
        $repository = \Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
            ->addAdapter(\Dotenv\Repository\Adapter\EnvConstAdapter::class)
//            ->addWriter(\Dotenv\Repository\Adapter\ArrayAdapter::class)
            ->addWriter(\Dotenv\Repository\Adapter\PutenvAdapter::class)
//            ->immutable()
            ->make();
        $repository->set('ROOT_DIRECTORY', $this->rootDirectory);
        $repository->set('APP_MODE', $this->mode);
        return $repository;
    }

    protected function saveContentsToPhpFile(array $contents): void
    {
        $parser = new Parser();
        $env = [];
        foreach ($contents as $contentName => $contentValue) {
            $collection = $parser->parse($contentValue);
            foreach ($collection as $entry) {
                $env[$contentName][$entry->getName()] = $entry->getValue()->get()->getChars();
            }
        }
        $store = new StoreFile(__DIR__ . '/../../../../../../../../var/env.php');
        $store->save($env);
    }

    protected function dump($env, $name)
    {
        ksort($env);
        file_put_contents(
            __DIR__ . '/../../../../../../../../../var/' . $name . '_' . $this->mode . '.json',
            json_encode($env, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }
}
