<?php

namespace ZnCore\Bundle\Interfaces;

/**
 * Загрузчики конфигураций бандла.
 */
interface BundleLoadersInterface
{

    /**
     * Получить загрузчики.
     *
     * @return array Массив имен загрузчиков
     */
    public function getLoaders(): array;
}
