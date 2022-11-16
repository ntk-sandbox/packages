<?php

namespace ZnUser\Notify\Domain\Enums\Rbac;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class NotifyMyHistoryPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oNotifyMyHistoryAll';
    const ONE = 'oNotifyMyHistoryOne';
    const DELETE = 'oNotifyMyHistoryDelete';
    const RESTORE = 'oNotifyMyHistoryRestore';
    const CLEAR_ALL = 'oNotifyMyHistoryClearAll';
    const READ_ALL = 'oNotifyMyHistoryReadAll';

    public static function getLabels()
    {
        return [
            self::ALL => 'Мои уведомления. Просмотр списка',
            self::ONE => 'Мои уведомления. Просмотр записи',
            self::DELETE => 'Мои уведомления. Удаление',
            self::RESTORE => 'Мои уведомления. Восстановление',
            self::CLEAR_ALL => 'Мои уведомления. Очистка истории',
            self::READ_ALL => 'Мои уведомления. Пометка списка прочитанных',
        ];
    }
}
