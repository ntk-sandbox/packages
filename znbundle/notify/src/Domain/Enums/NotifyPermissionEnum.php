<?php

namespace ZnBundle\Notify\Domain\Enums;

use ZnCore\Enum\Interfaces\GetLabelsInterface;

class NotifyPermissionEnum implements GetLabelsInterface
{

    const TEST_READ = 'oNotifyTestRead';

    public static function getLabels()
    {
        return [
            self::TEST_READ => 'Список тестовых сообщений. Чтение',
        ];
    }
}