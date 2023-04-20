<?php

namespace Untek\User\Person\Rpc\Controllers;

use Psr\Container\ContainerInterface;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Model\Query\Entities\Query;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Model\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Framework\Rpc\Presentation\Serializers\SerializerInterface;
use Untek\User\Person\Domain\Entities\InheritanceEntity;
use Untek\User\Person\Domain\Interfaces\Services\MyChildServiceInterface;
use Untek\User\Person\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\User\Person\Rpc\Serializers\MyChildSerializer;

class MyChildController extends BaseCrudRpcController
{

    use ContainerAwareTrait;

    private $personService;

    public function __construct(
        MyChildServiceInterface $myChildService,
        PersonServiceInterface $personService,
        ContainerInterface $container
    )
    {
        $this->service = $myChildService;
        $this->personService = $personService;
        $this->setContainer($container);
    }

    public function serializer(): SerializerInterface
    {
        return $this->getContainer()->get(MyChildSerializer::class);
    }

    /*public function allowRelations(): array
    {
        return [
            'child_person',
            'parent_person',
        ];
    }*/

    protected function forgeWith(RpcRequestEntity $requestEntity, Query $query)
    {
        $query->with(['child_person']);
        parent::forgeWith($requestEntity, $query);
    }

    public function persist(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $params = $requestEntity->getParams();
        $entity = $this->service->persistData($params);
        return $this->serializeResult($entity);
    }

    public function update(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $childPersonId = $requestEntity->getParamItem('id');
        $data = $requestEntity->getParams();

        unset($data['id']);

        $this->personService->updateById($childPersonId, $data);

        /** @var InheritanceEntity $inheritanceEntity */
        $inheritanceEntity = $this->service->findAll((new Query())->where('child_person_id', $childPersonId))->first();
        return $this->serializeResult($inheritanceEntity);
    }

    /*public function add(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        return parent::add($requestEntity);
    }

    public function update(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        return parent::update($requestEntity);
    }

    public function delete(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        return parent::delete($requestEntity);
    }*/

    /*public function attributesOnly(): array
    {
        return [
            'id',
            'value',
            'attributeId',
            'attribute.id',
            'attribute.name',
            'attribute.title',
            'attribute.description',
        ];
    }*/
}
