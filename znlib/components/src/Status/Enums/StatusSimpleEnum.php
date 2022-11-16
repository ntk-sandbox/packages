<?php

namespace ZnLib\Components\Status\Enums;

use ZnLib\I18Next\Facades\I18Next;
use ZnCore\Enum\Interfaces\GetLabelsInterface;

/**
 * Статусы сущности (сокращенный вариант)
 */
class StatusSimpleEnum implements GetLabelsInterface
{

    const ENABLED = 100;
    const DISABLED = 0;
    const DELETED = -10;

    public static function getLabels()
    {
        return [
            self::ENABLED => I18Next::t('core', 'status.enabled'),
            self::DISABLED => I18Next::t('core', 'status.disabled'),
            self::DELETED => I18Next::t('core', 'status.deleted'),
        ];
    }
}