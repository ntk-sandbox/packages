<?php

namespace ZnCore\App\Interfaces;

/**
 * Интерфейс инициализатора переменных окружения.
 */
interface EnvironmentInterface
{

    public function init(string $mode = null): void;
}
