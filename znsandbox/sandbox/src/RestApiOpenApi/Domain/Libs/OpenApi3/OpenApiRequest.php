<?php

namespace ZnSandbox\Sandbox\RestApiOpenApi\Domain\Libs\OpenApi3;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnLib\Components\Store\Drivers\Yaml;
use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Dto\RequestDto;
use ZnSandbox\Sandbox\RpcClient\Symfony4\Admin\Forms\RequestForm;
use ZnSandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

class OpenApiRequest
{

    private $sourceDirectory;

    public function __construct(string $sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
    }

    protected function generateRpcRequest(RpcRequestEntity $rpcRequestEntity, RpcResponseEntity $rpcResponseEntity)
    {
        $data = $this->getData($rpcRequestEntity);
        $data = $this->forgePaginate($rpcResponseEntity, $data);
        $data = $this->clearPayloadTails($data);
        $requestArray = [
            "jsonrpc" => "2.0",
            "method" => $rpcRequestEntity->getMethod(),
            "params" => $data,
        ];
        return $requestArray;
    }

    protected function clearPayloadTails($data)
    {
        if (empty($data['body'])) {
            unset($data['body']);
        }

        if (empty($data['meta'])) {
            unset($data['meta']);
        }
        return $data;
    }

    protected function generateRpcResponse(RpcRequestEntity $rpcRequestEntity, RpcResponseEntity $rpcResponseEntity)
    {
        $rpcResponse = [
            "jsonrpc" => "2.0",
        ];
        if ($rpcResponseEntity->getError()) {
            $rpcResponse['error'] = $rpcResponseEntity->getError();
        }
        if ($rpcResponseEntity->getResult()) {
            $rpcResponse['result']['body'] = $rpcResponseEntity->getResult();
        }
        $responseMeta = $rpcResponseEntity->getMeta();
        if ($responseMeta) {
            $rpcResponse['result']['meta'] = $responseMeta;
        }
        if (!empty($rpcResponse['result'])) {
            $rpcResponse['result'] = $this->clearPayloadTails($rpcResponse['result']);
        }
        return $rpcResponse;
    }

    protected function getData(RpcRequestEntity $rpcRequestEntity)
    {
        $data = [
            'body' => [],
            'meta' => [],
        ];
        if ($rpcRequestEntity->getParams()) {
            $data['body'] = $rpcRequestEntity->getParams();
        }
        if ($rpcRequestEntity->getMeta()) {
            $meta = $rpcRequestEntity->getMeta();
            if (array_key_exists('timestamp', $meta)) {
                unset($meta['timestamp']);
            }
            if (array_key_exists('version', $meta)) {
                unset($meta['version']);
            }
            if (array_key_exists('Authorization', $meta)) {
                unset($meta['Authorization']);
            }
            $data['meta'] = $meta;
        }
        return $data;
    }

    protected function isHasAuth(RpcRequestEntity $rpcRequestEntity): bool
    {
        if ($rpcRequestEntity->getMeta() == null) {
            return false;
        }
        return array_key_exists('Authorization', $rpcRequestEntity->getMeta());
    }

    protected function forgePaginate(RpcResponseEntity $rpcResponseEntity, $data)
    {
        $responseMeta = $rpcResponseEntity->getMeta();
        $isPaginate = isset($responseMeta['perPage']) && isset($responseMeta['totalCount']) && isset($responseMeta['page']);
        if ($isPaginate) {
            $data['body']['perPage'] = $responseMeta['perPage'];
            $data['body']['page'] = $responseMeta['page'];
        }
        return $data;
    }

    public function createPostRequest(RequestDto $requestDto) {

        // Request $request, Response $response, RequestForm $requestForm
        $dataSchemaEncoder = new DataSchema();

//        $rpcRequest = $this->generateRpcRequest($request, $response);



        $requestSchema = $dataSchemaEncoder->encode($requestDto->body);
//        dd($requestSchema);

        $requestSchema['example'] = $requestDto->body;

//        $rpcResponse = $this->generateRpcResponse($request, $response);

        $responseSchema = $dataSchemaEncoder->encode($requestDto->response->body);
        $responseSchema['example'] = $requestDto->response->body;

//        $methodName = $request->getMethod();
//        list($tag, $actionName) = explode('.', $methodName);

//        $tag = 'common';
        $tag = trim($requestDto->uri, '/');

        $actionName = $requestDto->uri;

        $postConfig = [
            'tags' => [
                $tag
            ],
            'summary' => 'Description',
            'requestBody' => [
                'content' => [
                    'application/json' => [
                        'schema' => $requestSchema
                    ]
                ],
            ],
            'responses' => [
                200 => [
                    'content' => [
                        'application/json' => [
                            'schema' => $responseSchema
                        ]
                    ]
                ]
            ],
        ];

//        dd($postConfig);

        /*$responseMeta = $response->getMeta();
        if ($responseMeta) {
            $postConfig['responses'][200]['headers'] = $dataSchemaEncoder->encode($responseMeta)['properties'];
        }

        if ($this->isHasAuth($request)) {
            $postConfig['security'][] = [
                'bearerAuth' => []
            ];
        }*/

        return $postConfig;
    }
}