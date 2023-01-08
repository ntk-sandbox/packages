<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins;

use ZnSandbox\Sandbox\WebTest\Domain\Interfaces\PluginInterface;
use ZnSandbox\Sandbox\WebTest\Domain\Traits\PluginParentTrait;

class JsonPlugin implements PluginInterface
{

    use PluginParentTrait;

    public function run(array $requestData): array
    {
        if ($requestData['data'] && isset($requestData['headers']['CONTENT_TYPE']) && $requestData['headers']['CONTENT_TYPE'] == 'application/json') {
            $requestData['content'] = json_encode($requestData['data']);
        }
        return $requestData;
    }

    public function asJson(): void
    {
//        dd($this->client);
        $this->client->withHeaders(
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        );
    }
}
