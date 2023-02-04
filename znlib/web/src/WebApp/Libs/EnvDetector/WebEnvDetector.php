<?php

namespace Untek\Lib\Web\WebApp\Libs\EnvDetector;

use Symfony\Component\HttpFoundation\Request;
use Untek\Core\Env\Interfaces\EnvDetectorInterface;

class WebEnvDetector implements EnvDetectorInterface
{

    public function __construct(private Request $request)
    {
    }

    public function isMatch(): bool
    {
        return $this->request->getRequestUri() != null;
    }

    public function isTest(): bool
    {
        $envNameFromHeader = $this->request->headers->get('env-name');
        $envNameFromQuery = $this->request->query->get('env');
        $isWebTest = $envNameFromHeader == 'test' || $envNameFromQuery == 'test';
        return $isWebTest;
    }
}
