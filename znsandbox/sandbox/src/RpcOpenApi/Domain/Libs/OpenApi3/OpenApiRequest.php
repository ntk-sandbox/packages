<?php

namespace ZnSandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\FileSystem\Helpers\FileStorageHelper;
use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnLib\Components\Store\Drivers\Yaml;
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

    public function createPostRequest(RpcRequestEntity $rpcRequestEntity, RpcResponseEntity $rpcResponseEntity, RequestForm $requestForm) {
        $dataSchemaEncoder = new DataSchema();

        $rpcRequest = $this->generateRpcRequest($rpcRequestEntity, $rpcResponseEntity);
        $requestSchema = $dataSchemaEncoder->encode($rpcRequest);
        $requestSchema['example'] = $rpcRequest;

        $rpcResponse = $this->generateRpcResponse($rpcRequestEntity, $rpcResponseEntity);
        $responseSchema = $dataSchemaEncoder->encode($rpcResponse);
        $responseSchema['example'] = $rpcResponse;

        $methodName = $rpcRequestEntity->getMethod();
        list($tag, $actionName) = explode('.', $methodName);

        $postConfig = [
            'tags' => [
                $tag
            ],
            'summary' => $requestForm->getDescription(),
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

        $responseMeta = $rpcResponseEntity->getMeta();
        if ($responseMeta) {
            $postConfig['responses'][200]['headers'] = $dataSchemaEncoder->encode($responseMeta)['properties'];
        }

        if ($this->isHasAuth($rpcRequestEntity)) {
            $postConfig['security'][] = [
                'bearerAuth' => []
            ];
        }

        return $postConfig;
    }
}