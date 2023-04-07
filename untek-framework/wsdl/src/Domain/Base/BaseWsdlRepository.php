<?php

namespace Untek\Framework\Wsdl\Domain\Base;

use SoapClient;
use Untek\Model\Repository\Base\BaseRepository;

abstract class BaseWsdlRepository extends BaseRepository
{

    protected $soapClient = null;

    abstract protected function getRequestLocation(): string;

    abstract protected function getRequestUri(): string;

    abstract protected function getDefinitionUrl(): string;

    protected function createSoapClient(): SoapClient
    {
        if ($this->soapClient == null) {
            $this->soapClient = $this->createSoapClientInstance();
        }
        return $this->soapClient;
    }

    protected function createSoapClientInstance(): SoapClient
    {
        $options = $this->getSoapClientOptions();
        $contextOptions = $this->getSoapClientContextOptions();
        if ($contextOptions) {
            $options['stream_context'] = stream_context_create($contextOptions);
        }
        $url = $this->getDefinitionUrl();
        $client = new SoapClient($url, $options);
        return $client;
    }

    protected function callFunction($functionName, $arguments, $options = null, $input_headers = null, &$output_headers = null)
    {
        $client = $this->createSoapClient();
        $result = $client->__soapCall($functionName, $arguments, $options, $input_headers, $output_headers);
        return $result;
    }

    protected function getSoapClientContextOptions(): array
    {
        return [
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
//                'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT
            ],
            'http' => [
                'user_agent' => 'PHPSoapClient'
            ]
        ];
    }

    protected function getSoapClientOptions(): array
    {
        return [
            'soap_version' => SOAP_1_1,
            'location' => $this->getRequestLocation(),
            'uri' => $this->getRequestUri(),
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
        ];
    }
}
