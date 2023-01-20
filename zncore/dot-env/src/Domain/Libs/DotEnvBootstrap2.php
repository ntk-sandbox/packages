<?php

namespace ZnCore\DotEnv\Domain\Libs;

use Symfony\Component\Dotenv\Dotenv;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Exceptions\NotFoundDependencyException;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnCore\DotEnv\Domain\Enums\DotEnvModeEnum;
use ZnCore\FileSystem\Helpers\FilePathHelper;
use ZnCore\Pattern\Singleton\SingletonTrait;

/**
 * Загрузчик переменных окружения
 */
class DotEnvBootstrap2
{

    use SingletonTrait;

    private $inited = false;

    /**
     * Инициализация переменных окружения
     *
     * @param string $mode Режим (main|test)
     * @param string|null $basePath Путь к корневой директории проекта
     */
    public function init(string $mode = DotEnvModeEnum::MAIN, string $basePath = null): void
    {
        if ($this->checkInit()) {
            return;
        }
        $this->checkSymfonyDotenvPackage();

        $basePath = $basePath ?: realpath(__DIR__ . '/../../../../../../../..');
        $this->initMode($mode);
        $this->initRootDirectory($basePath);
        $this->bootVlucasDotenv($basePath, $mode);
//        $this->bootFromLoader($basePath);
    }


    protected function getLoader(): DotEnvLoader
    {
        return new DotEnvLoader;
    }
    
    /**
     * Проверка повтроной инициализации
     *
     * @return bool
     */
    private function checkInit(): bool
    {
        $isInited = $this->inited;
        $this->inited = true;
        return $isInited;
    }

    /**
     * Инициализация переменной окружения 'APP_MODE'
     *
     * @param string $mode Режим (main|test)
     */
    private function initMode(string $mode): void
    {
        if (getenv('APP_MODE') == null || empty($_ENV['APP_MODE'])) {
            $_ENV['APP_MODE'] = $mode;
            putenv("APP_MODE=$mode");
        }
    }

    /**
     * Инициализация переменной окружения 'ROOT_DIRECTORY'
     *
     * @param string $basePath Путь к корневой директории проекта
     */
    public function initRootDirectory(string $basePath): void
    {
        $value = realpath($basePath);
        $_ENV['ROOT_DIRECTORY'] = $value;
        putenv("ROOT_DIRECTORY={$value}");
    }

    /**
     * Проверка установки пакета 'symfony/dotenv'
     *
     * @throws NotFoundDependencyException
     */
    private function checkSymfonyDotenvPackage(): void
    {
        ComposerHelper::requireAssert(Dotenv::class, 'symfony/dotenv', "4.*|5.*");
    }

    /**
     * Загрузка переменных окружения
     *
     * Порядок загрузки файлов:
     *  - .env
     *  - .env.local (.env.test - для тестового окружения)
     *
     * @param string $basePath Путь к папке с .env* конфигами
     */
    private function bootSymfonyDotenv(string $basePath): void
    {
//        (new Dotenv('APP_ENV', 'APP_DEBUG'))->bootEnv($basePath . '/.env', 'dev', ['test'], true);

        try {
            $dotEnv = new Dotenv(false);
            $dotEnv->usePutenv(true);
            $dotEnv->bootEnv($basePath . '/.env', 'dev', ['test'], true);
        } catch (\Symfony\Component\Dotenv\Exception\PathException $e) {
        }


        // load all the .env files
//        $dotEnv->loadEnv($basePath . '/.env');
    }

    private function bootFromLoader(string $basePath): void
    {
        $mode = getenv('APP_MODE');
        $mainEnv = $this->getLoader()->loadFromFile($basePath . '/.env');
        if($mode == 'test') {
            $localEnv = $this->getLoader()->loadFromFile($basePath . '/.env.test');
        } else {
            $localEnv = $this->getLoader()->loadFromFile($basePath . '/.env.local');
        }
        $env = ArrayHelper::merge($mainEnv, $localEnv);
        (new DotEnvWriter())->setAll($env);
    }

    private function bootFromCache(string $basePath): void
    {
        $env = include $basePath . '/.env.local.php';
        (new DotEnvWriter())->setAll($env);
    }

    private function bootVlucasDotenv(string $basePath, string $mode): void
    {
        $repository = \Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
            ->addAdapter(\Dotenv\Repository\Adapter\EnvConstAdapter::class)
            ->addWriter(\Dotenv\Repository\Adapter\PutenvAdapter::class)
//            ->immutable()
            ->make();
        $repository->set('ROOT_DIRECTORY', $basePath);
        $repository->set('APP_MODE', $mode);

        $names = [
            '.env',
            $mode == 'test' ? '.env.test' : '.env.local',
        ];
        $dotenv = \Dotenv\Dotenv::create($repository, $basePath, $names, false);
        $env = $dotenv->load();
//        (new DotEnvWriter())->setAll($env);
    }
}
