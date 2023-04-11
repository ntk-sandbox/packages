<?php

namespace Untek\Framework\Wsdl\Domain\Libs;

use GuzzleHttp\Client;
use Untek\Component\Encoder\Encoders\XmlEncoder;
use Untek\Component\Http\Enums\HttpHeaderEnum;

class SoapClient
{

    private $requestUrl;
    private $definitionUrl;
    private $baseDefinitionUrl;

    public function getDefinitionUrl()
    {
        return $this->definitionUrl;
    }

    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    public function setRequestUrl($requestUrl): void
    {
        $this->requestUrl = $requestUrl;
    }

    public function setDefinitionUrl($definitionUrl): void
    {
        $this->definitionUrl = $definitionUrl;
    }

    public function getBaseDefinitionUrl()
    {
        return $this->baseDefinitionUrl;
    }

    public function setBaseDefinitionUrl($baseDefinitionUrl): void
    {
        $this->baseDefinitionUrl = $baseDefinitionUrl;
    }

    public function sendRequest(string $xmlRequest): string
    {
        $this->checkDefinition();
        $options = [
            'body' => $xmlRequest,
        ];
        $response = $this->getClient($this->requestUrl)->post('', $options);
        return $response->getBody()->getContents();
    }

    public function getDefinition(string $url = ''): string
    {
        $url = $this->baseDefinitionUrl . '/' . $url;
        $response = $this->getClient()->get($url);
        return $response->getBody()->getContents();
    }

    public function sendXmlRequest(string $xmlRequest, string $url): string
    {
        $options = [
            'body' => $xmlRequest,
        ];
        $response = $this->getClient()->post($url, $options);
        return $response->getBody()->getContents();
    }

    protected function checkDefinition()
    {
//        dd($this->definitionUrl);
        $cc = new \SoapClient($this->definitionUrl);
        $definitionXml = file_get_contents($this->definitionUrl);
        $xmlEncoder = new XmlEncoder();
        $actual = $xmlEncoder->decode($definitionXml);
        if (empty($actual) || empty($actual['definitions'])) {
            throw new \Exception('Empty WSDL definition!');
        }
    }

    protected function getClient(string $baseUrl = null): Client
    {
        $config = [
            'verify' => false,
//            'verify' => '/...../root_rsa.crt',
            'base_uri' => $baseUrl,
            'headers' => [
                HttpHeaderEnum::CONTENT_TYPE => 'text/xml',
                'env-name' => 'test',
            ],
        ];
        return new Client($config);
    }
}
