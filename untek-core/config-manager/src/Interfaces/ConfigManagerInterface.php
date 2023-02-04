<?php

namespace Untek\Core\ConfigManager\Interfaces;

/**
 * Реестр для хранения конфигов.
 */
interface ConfigManagerInterface
{

    /**
     * Сохранить конфиг в реестре
     * 
     * @param string $name Имя конфига
     * @param mixed $value Конфиг
     */
    public function set(string $name, $value): void;

    /**
     * Получить конфиг из реестра.
     * 
     * @param string $name Имя конфига
     * @param null $defaultValue Значение по умолчанию
     * @return mixed
     */
    public function get(string $name, $defaultValue = null);
}
