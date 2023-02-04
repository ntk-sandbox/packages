<?php

namespace Untek\Database\Migration\Domain\Repositories;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Code\Exceptions\DeprecatedException;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;
use Untek\Core\Contract\Common\Exceptions\InvalidConfigException;
use Untek\Core\FileSystem\Helpers\FilePathHelper;
use Untek\Core\FileSystem\Helpers\FindFileHelper;
use Untek\Database\Migration\Domain\Entities\MigrationEntity;

class SourceRepository
{

    private $configManager;

    public function __construct(/*$config = null, */ ConfigManagerInterface $configManager)
    {
        $this->configManager = $configManager;
    }

    public function getAll()
    {
        $directories = $this->configManager->get('ELOQUENT_MIGRATIONS');
        if (empty($directories)) {
            return [];
            throw new InvalidConfigException('Empty directories configuration for migrtion!');
        }
        $classes = [];
        foreach ($directories as $dir) {
            if(is_dir($dir)) {
                $migrationDir = realpath($dir);
            } else {
                throw new DeprecatedException('Migration path format deprecated!');
                $migrationDir = realpath(FilePathHelper::prepareRootPath($dir));
            }
            $newClasses = self::scanDir($migrationDir);
            $classes = ArrayHelper::merge($classes, $newClasses);
        }
        return $classes;
    }

    private static function scanDir($dir)
    {
        $files = FindFileHelper::scanDir($dir);
        $classes = [];
        foreach ($files as $file) {
            $classNameClean = FilePathHelper::fileRemoveExt($file);
            $entity = new MigrationEntity;
            $entity->className = 'Migrations\\' . $classNameClean;
            $entity->fileName = $dir . DIRECTORY_SEPARATOR . $classNameClean . '.php';
            $entity->version = $classNameClean;
            include_once($entity->fileName);
            $classes[] = $entity;
        }
        return $classes;
    }

}