<?php

namespace Untek\Framework\Wsdl\Domain\Base;

use Untek\Component\Web\WebApp\Base\BaseWebApp;

abstract class BaseWsdlApp extends BaseWebApp
{

    public function appName(): string
    {
        return 'wsdl';
    }
}
