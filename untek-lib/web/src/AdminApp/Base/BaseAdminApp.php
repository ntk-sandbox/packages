<?php

namespace Untek\Lib\Web\AdminApp\Base;

use Untek\Lib\Web\WebApp\Base\BaseWebApp;

abstract class BaseAdminApp extends BaseWebApp
{

    public function appName(): string
    {
        return 'admin';
    }

    public function import(): array
    {
        return ['i18next', 'container', 'entityManager', 'eventDispatcher', 'rbac', 'symfonyAdmin'];
    }
}
