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

class OpenApi3
{

    private $sourceDirectory;

    public function __construct(string $sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
    }

    public function encode(
        RpcRequestEntity $rpcRequestEntity,
        RpcResponseEntity $rpcResponseEntity,
        RequestForm $requestForm
    ) {
        $dataSchemaEncoder = new DataSchema();
        $paramsSchemaEncoder = new ParametersSchema();

        if ($rpcRequestEntity) {
            $encoder = new Yaml(2);

            $data = [
                'body' => [],
                'meta' => [],
            ];
            if ($rpcRequestEntity->getParams()) {
                $data['body'] = $rpcRequestEntity->getParams();
            }
            $hasAuth = false;
            if ($rpcRequestEntity->getMeta()) {
                $meta = $rpcRequestEntity->getMeta();
                if (array_key_exists('timestamp', $meta)) {
                    unset($meta['timestamp']);
                }
                if (array_key_exists('Authorization', $meta)) {
                    $hasAuth = true;
                    unset($meta['Authorization']);
                }
//                unset($meta['']);
                /*if (array_key_exists('Authorization', $meta)) {
                    $hasAuth = true;
                    $meta['Authorization'] = 'bearer xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
                }*/
                $data['meta'] = $meta;
            }

            $responseMeta = $rpcResponseEntity->getMeta();

            $isPaginate = isset($responseMeta['perPage']) && isset($responseMeta['totalCount']) && isset($responseMeta['page']);
            if ($isPaginate) {
                $data['body']['perPage'] = $responseMeta['perPage'];
                $data['body']['page'] = $responseMeta['page'];
            }

            if(empty($data['body'])) {
                unset($data['body']);
            }

            if(empty($data['meta'])) {
                unset($data['meta']);
            }

            $requestArray = [
                "jsonrpc"=> "2.0",
                "method" => $rpcRequestEntity->getMethod(),
                "params"=> $data,
                "id" => 1,
            ];

            $req = $dataSchemaEncoder->encode($requestArray);
            //if($data) {
                $req['example'] = $requestArray;
            //}

            $respData = [
                "jsonrpc" => "2.0",
            ];

            if($rpcResponseEntity->getError()) {
                $respData['error'] = $rpcResponseEntity->getError();
            }

            if ($rpcResponseEntity->getResult()) {
                $respData['result']['body'] = $rpcResponseEntity->getResult();
            }

            if ($responseMeta) {
                $respData['result']['meta'] = $responseMeta;
            }

            $respData['id'] = 1;

            $resp = $dataSchemaEncoder->encode($respData);
            if($respData) {
                $resp['example'] = $respData;
            }

            $methodName = $rpcRequestEntity->getMethod();
            list($tag, $actionName) = explode('.', $methodName);

            $rpcRequestArray = EntityHelper::toArray($rpcRequestEntity);
            unset($rpcRequestArray['meta']['timestamp']);

            $hash = HasherHelper::generateDigest($rpcRequestArray);

//            $jj = json_encode($rpcRequestArray, JSON_PRETTY_PRINT);
//            $hash = hash('crc32b', $jj);


            $actionHash = $actionName . '-' . $hash;
//            dd($tagHash);

            $postConfig = [
                'tags' => [
                    $tag
                ],
                'summary' => $requestForm->getDescription(),
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => $req
                        ]
                    ],
                ],
                'responses' => [
                    200 => [
                        'content' => [
                            'application/json' => [
                                'schema' => $resp
                            ]
                        ]
                    ]
                ],
            ];

            if ($responseMeta) {
                $postConfig['responses'][200]['headers'] = $dataSchemaEncoder->encode($responseMeta)['properties'];
            }

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


            if ($hasAuth) {
                $postConfig['security'][] = [
                    'bearerAuth' => []
                ];
            }

            $res = [
                'paths' => [
                    $actionName => [
                        'post' => $postConfig,
                    ],
                ],
            ];

            $yaml = $encoder->encode($res);
            $docsDir = $this->sourceDirectory . "/v1";

            $endPointPath = "$tag/$actionHash.yaml";
            $endPointFile = "$docsDir/$endPointPath";
            FileStorageHelper::save($endPointFile, $yaml);
            $mainFile = "$docsDir/index.yaml";
            $mainYaml = file_get_contents($mainFile);
            $main = $encoder->decode($mainYaml);
            $main['paths']["/$methodName#$hash"]['$ref'] = "./$endPointPath#/paths/$actionName";

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

            $mainYaml = $encoder->encode($main);
            file_put_contents($mainFile, $mainYaml);
        }
    }
}