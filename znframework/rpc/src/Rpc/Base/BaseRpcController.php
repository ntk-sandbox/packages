<?php

namespace ZnFramework\Rpc\Rpc\Base;

use ZnCore\Text\Helpers\Inflector;
use ZnDomain\Query\Entities\Query;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Helpers\ResponseHelper;
use ZnFramework\Rpc\Rpc\Interfaces\RpcAuthInterface;
use ZnFramework\Rpc\Rpc\Serializers\DefaultSerializer;
use ZnFramework\Rpc\Rpc\Serializers\SerializerInterface;

abstract class BaseRpcController implements RpcAuthInterface
{

    protected $service;

    public function attributesOnly(): array
    {
        return [];
    }

    /**
     * Атрибуты сущности, исключенные из сериализации
     * @return array
     */
    public function attributesExclude(): array
    {
        return [];
    }

    public function serializer(): SerializerInterface
    {
        $serializer = new DefaultSerializer();
        $serializer->setAttributesOnly($this->attributesOnly());
        $serializer->setAttributesExclude($this->attributesExclude());
        return $serializer;
    }

    public function auth(): array
    {
        return [
            "*"
        ];
    }

    protected function serializeResult($result): RpcResponseEntity
    {
        $serializer = $this->serializer();
        $result = $serializer->encode($result);
        return ResponseHelper::forgeRpcResponseEntity($result);
    }

    public function allowRelations(): array
    {
        return [

        ];
    }

    protected function forgeWith(RpcRequestEntity $requestEntity, Query $query)
    {
        $with = $requestEntity->getParamItem('with');
        if($with) {
            $this->forgeWithfromrray($with, $query);
        }
    }

    protected function forgeWithfromrray(array $with, Query $query) {
        if ($with) {
            $withItems = [];
            foreach ($with as $relationName) {
                $relationNameSnakeCase = $this->underscore($relationName);
                $relationNameCamelCase = $this->variablize($relationName);
                if (in_array($relationNameSnakeCase, $this->allowRelations()) || in_array($relationNameCamelCase, $this->allowRelations())) {
                    $withItems[] = $relationNameSnakeCase;
                }
            }
            $query->with($withItems);
        }
    }

    protected function underscore(string $name): string
    {
        $names = explode('.', $name);
        foreach ($names as &$nameItem) {
            $nameItem = Inflector::underscore($nameItem);
        }
        return implode('.', $names);
    }

    protected function variablize(string $name): string
    {
        $names = explode('.', $name);
        foreach ($names as &$nameItem) {
            $nameItem = Inflector::variablize($nameItem);
        }
        return implode('.', $names);
    }
}
