<?php

namespace ZnLib\Web\RestApiApp\Base;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use ZnLib\Components\Http\Enums\HttpMethodEnum;

abstract class BaseHttpRepository
{

    protected Client $client;

    abstract public function url(): string;

    abstract protected function handleError(array $body, array $codeToField): void;

    protected function request(string $uri, string $method, array $postParams = []): Response
    {
        $options = $this->getOptions($uri, $method, $postParams);
        $endpoint = $this->url() . '/' . $uri;
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
