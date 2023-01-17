<?php

namespace ZnSandbox\Sandbox\RestApiOpenApi\Domain\Libs\OpenApi3;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnLib\Components\Store\Drivers\Php;
use ZnLib\Components\Store\Drivers\Yaml;
use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Dto\RequestDto;
use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Dto\ResponsetDto;
use ZnSandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;
use ZnSandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;
use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Helpers\RequestHelper;

class OpenApi3
{

    private $sourceDirectory;
    private $openApiRequest;

    public function __construct(string $sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
        $this->openApiRequest = new OpenApiRequest($sourceDirectory);
    }

    protected function extractHeaders($all) {
        $headers = [];
        foreach ($all as $headerKey => $headerValues) {
            $headers[$headerKey] = $headerValues[0];
        }
        return $headers;
    }

    protected function createRequsetDto(Request $request, Response $response): RequestDto {
        $requestDto = new RequestDto();
        $requestDto->method = $request->getMethod();
        $requestDto->uri = $request->getRequestUri();

        $requestDto->uri = str_replace('/rest-api', '', $requestDto->uri);

        $requestDto->headers = $this->extractHeaders($request->headers->all());

        $requestDto->body = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);

        $responseDto = new ResponsetDto();
        $responseDto->statusCode = $response->getStatusCode();
        $responseDto->body = json_decode($response->getContent(), JSON_OBJECT_AS_ARRAY);
        $responseDto->headers = $this->extractHeaders($response->headers->all());

        $requestDto->response = $responseDto;

        return $requestDto;
    }

    public function encode(Request $request, Response $response) {
        $requestDto = $this->createRequsetDto($request, $response);
//        dd($requestDto);

        $postConfig = $this->openApiRequest->createPostRequest($requestDto);

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


        $this->makeEndpointConfig($requestDto, $postConfig);

        $tag = trim($requestDto->uri, '/');
//        $actionName = $requestDto->uri;
//        dd(123);

//        $methodName = $request->getMethod();
//        list($tag, $actionName) = explode('.', $methodName);

        $main = $this->getPathsForMain($requestDto);
//        dd($main);
        $this->addPathInMain($main, $tag);
    }

    protected function getPathsForMain(RequestDto $requestDto)
    {
//        $tag = trim($requestDto->uri, '/');

        $actionName = $requestDto->uri;

        $methodName = $requestDto->uri;
//        list($tag, $actionName) = explode('.', $methodName);
        $endPointPath = $this->getEndpointFileName($requestDto);

//        $hash = RequestHelper::generateHash($requestDto);
        $main['paths'][$actionName]['$ref'] = "./$endPointPath";
        return $main;
    }

    protected function getEndpointFileName(RequestDto $requestDto)
    {
        $endPointPath = trim($requestDto->uri, '/');
//        $endPointPath = $endPointPath . '/' . mb_strtolower($requestDto->method);
        return $endPointPath . '.yaml';

//        $methodName = $requestDto->getMethod();
//        list($tag, $actionName) = explode('.', $methodName);
//        $hash = RequestHelper::generateHash($requestDto);
//        $actionHash = $actionName . '-' . $hash;
//        $endPointPath = "$tag/$actionHash.yaml";
//        return $endPointPath;
    }

    protected function makeEndpointConfig(RequestDto $requestDto, array $postConfig)
    {
        $methodName = mb_strtolower($requestDto->method);
        $actionName = $requestDto->uri;
//        dd($actionName);
//        list($tag, $actionName) = explode('.', $methodName);
        $res = [
//            'paths' => [
//                $actionName => [
                    $methodName => $postConfig,
//                ],
//            ],
        ];

//        dd($res);

//        $endPointPath = trim($requestDto->uri, '/');
//        $endPointPath = $endPointPath . '/' . $requestDto->method;

//        dd($endPointPath);
//        dd($res);
        $endPointPath = $this->getEndpointFileName($requestDto);

        $config = $this->loadYaml($endPointPath);
        $config = array_merge($config, $res);

        $this->saveYaml($endPointPath, $config);
    }

    protected function saveYaml($fileName, $data)
    {
        $encoder = new Yaml(2);
        $docsDir = $this->sourceDirectory . "/v1";
        $mainYaml = $encoder->encode($data);
        $mainFile = "$docsDir/$fileName";
//        dd($mainFile);
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
        } else {
            $hasTag = false;
        }

        if (!$hasTag) {
            $main['tags'][] = [
                'name' => $tag,
                'description' => Inflector::titleize($tag),
            ];
        }

        $this->saveYaml('index.yaml', $main);
    }
}