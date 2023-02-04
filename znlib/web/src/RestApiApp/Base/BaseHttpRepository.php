<?php

namespace Untek\Lib\Web\RestApiApp\Base;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Untek\Lib\Components\Http\Enums\HttpMethodEnum;

abstract class BaseHttpRepository
{

    protected Client $client;

    public function url(): ?string {
        return null;
    }

    abstract protected function handleError(array $body, array $codeToField): void;

    protected function request(string $uri, string $method, array $postParams = []): Response
    {
        $baseUrl = $this->url();
        $options = $this->getOptions($uri, $method, $postParams);
        if($baseUrl) {
            $endpoint = $baseUrl . '/' . $uri;
        } else {
            $endpoint = $uri;
        }
        return $this->runRequest($method, $endpoint, $options);
    }

    protected function runRequest(string $method, string $endpoint, array $options): ResponseInterface
    {
        $method = strtoupper($method);
        try {
            $response = $this->client->request($method, $endpoint, $options);
        } catch (Throwable $exception) {
            $response = $exception->getResponse();
        }
        return $response;
    }

    protected function getOptions(string $uri, string $method, array $postParams = []): array
    {
        $options = [];
        if (strtoupper($method) == HttpMethodEnum::GET) {
            $options['query'] = $postParams;
        } else {
            $options['json'] = $postParams;
        }
        return $options;
    }
}
