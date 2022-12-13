<?php

namespace ZnCore\Bundle\Base;


/**
 * Абстрактный класс бандла.
 *
 * @method string getName() Имя бандла
 *
 * @method array container() конфигурация контейнера (DI)
 * @method array entityManager() конфигурация менеджера сущностей
 * @method array eventDispatcher() конфигурация диспетчера событий
 * @method array i18next() переводы в формате I18Next
 * @method array rbac() конфигурация ролей, полномочий, наследования RBAC
 * @method array migration() миграции БД
 * @method array console() команды консоли
 * @method array symfonyRpc() RPC-роуты
 * @method array symfonyAdmin() роуты админки
 * @method array symfonyWeb() роуты пользовательской части
 * @method array telegramRoutes() роуты для Telegram-бота
 */
abstract class BaseBundle
{

    private $importList;

    /**
     * Зависимости (бандлы)
     * @return array
     */
    public function deps(): array
    {
        return [];
    }

    /**
     * Что импортировать из бандлов:
     *
     * container - конфигурация контейнера (DI)
     * entityManager - конфигурация менеджера сущностей
     * i18next - переводы в формате I18Next
     * rbac - конфигурация ролей, полномочий, наследования RBAC
     * migration - миграции БД
     * console - команды консоли
     * symfonyRpc - RPC-роуты
     * symfonyAdmin - роуты админки
     * symfonyWeb - роуты пользовательской части
     * telegramRoutes - роуты для Telegram-бота
     *
     * @return array
     */
    public function getImportList(): array
    {
        return $this->importList;
    }

    /**
     *
     * @param array $importList
     */
    public function __construct(array $importList = [])
    {
        $this->importList = $importList;
    }

//    /**
//     * команды консоли
//     * @return array
//     */
//    public function console(): array
//    {
//        return [];
//    }

//    /**
//     * конфигурация контейнера (DI)
//     * @return array
//     */
//    public function container(): array
//    {
//        return [];
//    }

//    /**
//     * конфигурация менеджера сущностей
//     * @return array
//     */
//    public function entityManager(): array
//    {
//        return [];
//    }

//    /**
//     * конфигурация ролей, полномочий, наследования RBAC
//     * @return array
//     */
//    public function rbac(): array
//    {
//        return [];
//    }
}
