<?php

namespace Untek\User\Notify\Domain\Enums;

use Untek\Core\Enum\Interfaces\GetLabelsInterface;
use Untek\Lib\I18Next\Facades\I18Next;

class NotifyStatusEnum implements GetLabelsInterface
{

    const NEW = 100;
    const SEEN = 200;

    //const DELETED = -10;

    public static function getLabels()
    {
        return [
            self::NEW => I18Next::t('user.notify', 'history.status.new'),
            self::SEEN => I18Next::t('user.notify', 'history.status.seen'),
            //self::DELETED => I18Next::t('core', 'status.deleted'),
        ];
    }
}
