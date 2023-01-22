<?php

namespace ZnLib\Components\Http\Helpers;

use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class SymfonyHttpResponseHelper
{

    public static function extractHeaders($all)
    {
        $headers = [];
        foreach ($all as $headerKey => $headerValues) {
            $headers[$headerKey] = $headerValues[0];
        }
        return $headers;
    }

    public static function toPsr7Response(Response $symfonyResponse): ResponseInterface
    {
        $headers = SymfonyHttpResponseHelper::extractHeaders($symfonyResponse->headers->all());
        $psr7Response = new GuzzleHttpResponse($symfonyResponse->getStatusCode(), $headers, $symfonyResponse->getContent());
        return $psr7Response;
    }
}