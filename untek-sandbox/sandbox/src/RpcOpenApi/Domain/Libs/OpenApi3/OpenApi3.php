<?php

namespace Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Lib\Components\Store\Drivers\Php;
use Untek\Lib\Components\Store\Drivers\Yaml;
use Untek\Sandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;
use Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Helpers\RequestHelper;

class OpenApi3
{

    private $sourceDirectory;
    private $openApiRequest;

    public function __construct(string $sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
        $this->openApiRequest = new OpenApiRequest($sourceDirectory);
    }

    public function encode(
        RpcRequestEntity $rpcRequestEntity,
        RpcResponseEntity $rpcResponseEntity,
        RequestForm $requestForm
    ) {
        $postConfig = $this->openApiRequest->createPostRequest($rpcRequestEntity, $rpcResponseEntity, $requestForm);

        $paramsSchemaEncoder = new ParametersSchema();
        /*$postConfig['parameters'] = [];

        if ($data['meta']) {
            $parameters = $paramsSchemaEncoder->encode($data['meta']);
            $postConfig['parameters'] = ArrayHelper::merge(
                $postConfig['parameters'],
                $parameters
            );
        }
        if ($data['body']) {
            $parameters = $paramsSchemaEncoder->encode($data['body'], 'body');
            $postConfig['parameters'] = ArrayHelper::merge(
                $postConfig['parameters'],
                $parameters
            );
        }*/


        $this->makeEndpointConfig($rpcRequestEntity, $postConfig);

        $methodName = $rpcRequestEntity->getMethod();
        list($tag, $actionName) = explode('.', $methodName);

        $main = $this->getPathsForMain($rpcRequestEntity);
        $this->addPathInMain($main, $tag);
    }

    protected function getPathsForMain($rpcRequestEntity)
    {
        $methodName = $rpcRequestEntity->getMethod();
        list($tag, $actionName) = explode('.', $methodName);
        $endPointPath = $this->getEndpointFileName($rpcRequestEntity);
        $hash = RequestHelper::generateHash($rpcRequestEntity);
        $main['paths']["/$methodName#$hash"]['$ref'] = "./$endPointPath#/paths/$actionName";
        return $main;
    }

    protected function getEndpointFileName($rpcRequestEntity)
    {
        $methodName = $rpcRequestEntity->getMethod();
        list($tag, $actionName) = explode('.', $methodName);
        $hash = RequestHelper::generateHash($rpcRequestEntity);
        $actionHash = $actionName . '-' . $hash;
        $endPointPath = "$tag/$actionHash.yaml";
        return $endPointPath;
    }

    protected function makeEndpointConfig(RpcRequestEntity $rpcRequestEntity, array $postConfig)
    {
        $methodName = $rpcRequestEntity->getMethod();
        list($tag, $actionName) = explode('.', $methodName);
        $res = [
            'paths' => [
                $actionName => [
                    'post' => $postConfig,
                ],
            ],
        ];

        $endPointPath = $this->getEndpointFileName($rpcRequestEntity);
        $this->saveYaml($endPointPath, $res);
    }

    protected function saveYaml($fileName, $data)
    {
        $encoder = new Yaml(2);
        $docsDir = $this->sourceDirectory . "/v1";
        $mainYaml = $encoder->encode($data);
        $mainFile = "$docsDir/$fileName";
        FileStorageHelper::save($mainFile, $mainYaml);
    }

    protected function loadYaml($fileName)
    {
        $encoder = new Yaml(2);
        $docsDir = $this->sourceDirectory . "/v1";
        $mainFile = "$docsDir/$fileName";
        $yaml = file_get_contents($mainFile);
        return $encoder->decode($yaml);
    }

    protected function addPathInMain(array $config, string $tag)
    {
        $main = $this->loadYaml('index.yaml');

        $main = ArrayHelper::merge($main, $config);
        ksort($main['paths']);

        if ($main['tags']) {
            $hasTag = false;
            foreach ($main['tags'] as $tagItem) {
                if ($tagItem['name'] == $tag) {
                    $hasTag = true;
                }
            }
            if (!$hasTag) {
                $main['tags'][] = [
                    'name' => $tag,
                    'description' => Inflector::titleize($tag),
                ];
            }
        }

        $this->saveYaml('index.yaml', $main);
    }
}