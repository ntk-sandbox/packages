<?php

namespace ZnCore\DotEnv\Domain\Libs;

use Symfony\Component\Dotenv\Dotenv;
use ZnCore\Code\Exceptions\NotFoundDependencyException;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnCore\DotEnv\Domain\Enums\DotEnvModeEnum;
use ZnCore\FileSystem\Helpers\FilePathHelper;
use ZnCore\Pattern\Singleton\SingletonTrait;

/**
 * Загрузчик переменных окружения
 */
class DotEnvBootstrap
{

    use SingletonTrait;

    private $inited = false;

    /*public static function load(string $mode = DotEnvModeEnum::MAIN, string $basePath = null)
    {
        DotEnvBootstrap::getInstance()->init($mode, $basePath);
    }*/

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

        $basePath = $basePath ?: FilePathHelper::rootPath();
        $this->initMode($mode);
        $this->initRootDirectory($basePath);
        $this->bootSymfonyDotenv($basePath);
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
        if (empty($_ENV['APP_MODE'])) {
            $_ENV['APP_MODE'] = $mode;
        }
    }

    /**
     * Инициализация переменной окружения 'ROOT_DIRECTORY'
     *
     * @param string $basePath Путь к корневой директории проекта
     */
    private function initRootDirectory(string $basePath): void
    {
        $_ENV['ROOT_DIRECTORY'] = realpath($basePath);
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


        $dotEnv = new Dotenv(false);
        $dotEnv->bootEnv($basePath . '/.env', 'dev', ['test'], true);


        // load all the .env files
//        $dotEnv->loadEnv($basePath . '/.env');
    }
}
