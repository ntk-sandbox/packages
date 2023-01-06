<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Libs;

use ZnSandbox\Sandbox\Debug\Domain\Entities\ProfilingEntity;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;

class Profiler
{

    static protected $collection;

    public static function add(string $eventName)
    {
        $profilingEntity = self::createEntity($eventName);
        self::getCollection()->add($profilingEntity);
    }

    public static function calc(float $time = null, float $currentTime = null): float
    {

    }

    /**
     * @return Enumerable | ProfilingEntity[]
     */
    public static function all(): Enumerable
    {
        $collection = self::getCollection();
        foreach ($collection as $index => $profilingEntity) {
            /** @var ProfilingEntity $prevProfilingEntity */
            $prevProfilingEntity = $collection->get($index - 1);
            if ($prevProfilingEntity) {
                $lastMicrotime = $prevProfilingEntity->getTimestamp();
            } else {
                $lastMicrotime = $_SERVER['MICRO_TIME'];
            }
            $relativeMicrotime = round($profilingEntity->getTimestamp() - $lastMicrotime, 4);
            $profilingEntity->setRuntime($relativeMicrotime);
        }
        return $collection;
    }

    /**
     * @return Enumerable | ProfilingEntity[]
     */
    private static function getCollection(): Enumerable
    {
        if (!self::$collection) {
            self::$collection = new Collection();
            self::$collection->add(self::createEntity('start', $_SERVER['MICRO_TIME']));
        }
        return self::$collection;
    }

    private static function createEntity(string $eventName, float $time = null): ProfilingEntity
    {
        $time = $time ?: microtime(true);
        $profilingEntity = new ProfilingEntity();
        $profilingEntity->setName($eventName);
        $profilingEntity->setTimestamp($time);
        return $profilingEntity;
    }

    private static function createItem(string $eventName, float $time = null): array
    {
        $time = $time ?: microtime(true);
        return [
            'name' => $eventName,
            'timestamp' => $time,
        ];
    }
}
