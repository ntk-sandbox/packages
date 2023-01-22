<?php

namespace ZnSandbox\Sandbox\WebTest\Domain\Libs\Plugins;

use ZnSandbox\Sandbox\WebTest\Domain\Dto\RequestDataDto;
use ZnSandbox\Sandbox\WebTest\Domain\Interfaces\PluginInterface;
use ZnSandbox\Sandbox\WebTest\Domain\Traits\PluginParentTrait;

class JsonPlugin implements PluginInterface
{

    use PluginParentTrait;

    const MIME_TYPE = 'application/json';

    public function run(RequestDataDto $requestDataDto): void
    {
        $isJsonType = isset($requestDataDto->headers['CONTENT_TYPE']) && $requestDataDto->headers['CONTENT_TYPE'] == self::MIME_TYPE;

        if($isJsonType) {
            if ($requestDataDto->data) {
                $requestDataDto->content = json_encode($requestDataDto->data);
            }
//            $requestDataDto->headers['CONTENT_LENGTH'] = mb_strlen($requestDataDto->content, '8bit');
        }
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
