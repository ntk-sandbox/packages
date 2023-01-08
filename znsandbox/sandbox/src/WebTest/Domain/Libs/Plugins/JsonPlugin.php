<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins;

use ZnSandbox\Sandbox\WebTest\Domain\Interfaces\PluginInterface;
use ZnSandbox\Sandbox\WebTest\Domain\Traits\PluginParentTrait;

class JsonPlugin implements PluginInterface
{

    use PluginParentTrait;

    const MIME_TYPE = 'application/json';

    public function run(array $requestData): array
    {
        $isJsonType = isset($requestData['headers']['CONTENT_TYPE']) && $requestData['headers']['CONTENT_TYPE'] == self::MIME_TYPE;

        if($isJsonType) {
            if ($requestData['data']) {
                $requestData['content'] = json_encode($requestData['data']);
            }
            $requestData['headers']['CONTENT_LENGTH'] = mb_strlen($requestData['content'], '8bit');
        }

        return $requestData;
    }

    public function asJson(): void
    {
        $this->client->withHeaders(
            [
                'Content-Type' => self::MIME_TYPE,
                'Accept' => self::MIME_TYPE,
            ]
        );
    }
}
