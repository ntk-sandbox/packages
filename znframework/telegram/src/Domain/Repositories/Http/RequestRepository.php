<?php


namespace ZnFramework\Telegram\Domain\Repositories\Http;

use ZnFramework\Telegram\Domain\Entities\ChatEntity;
use ZnFramework\Telegram\Domain\Entities\FromEntity;
use ZnFramework\Telegram\Domain\Entities\MessageEntity;
use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Telegram\Domain\Helpers\RequestHelper;

class RequestRepository
{

    public function getRequest(): RequestEntity {
        $request = $this->body();


        $content = '=== JSON ===';
        $content .= PHP_EOL . PHP_EOL;
        $content .= \GuzzleHttp\json_encode($request, JSON_PRETTY_PRINT);
        $content .= PHP_EOL . PHP_EOL;
        $content .= '=== HTTP QUERY ===';
        $content .= PHP_EOL . PHP_EOL;
        $content .= http_build_query($request);
        $content .= PHP_EOL . PHP_EOL;
        //dd($dd);
        //file_put_contents(__DIR__ . '/../../../../public_html/var/out.txt', $content);

        return RequestHelper::forgeRequestEntityFromUpdateArray($request);
    }

    public function getToken() {
        return $_GET['token'] ?? null;
    }

    private function body() {
        $json = file_get_contents('php://input');
        $body = json_decode($json, TRUE);
        if(empty($body)) {
            $body = $_POST;
        }
        if(empty($body)) {
            $body = $_GET;
            unset($body['token']);
        }
        if(empty($body)) {
            throw new \Exception('Empty body!');
        }
        return $body;
    }
}