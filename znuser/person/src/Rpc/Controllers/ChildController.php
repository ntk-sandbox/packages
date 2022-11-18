<?php

namespace ZnUser\Person\Rpc\Controllers;

use ZnUser\Person\Domain\Entities\PersonStrictEntity;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Validator\Helpers\ValidationHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseCrudRpcController;
use ZnFramework\Rpc\Rpc\Serializers\SerializerInterface;
use ZnUser\Person\Domain\Interfaces\Services\ChildServiceInterface;
use ZnUser\Person\Domain\Interfaces\Services\PersonServiceInterface;
use ZnUser\Person\Rpc\Serializers\MyChildSerializer;

class ChildController extends BaseCrudRpcController
{

    use ContainerAwareTrait;

    private $personService;

    public function __construct(
        ChildServiceInterface $childService,
        PersonServiceInterface $personService,
        ContainerInterface $container
    )
    {
        $this->service = $childService;
        $this->personService = $personService;
        $this->setContainer($container);
    }

    public function serializer(): SerializerInterface
    {
        return $this->getContainer()->get(MyChildSerializer::class);
    }

    public function persist(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $params = $requestEntity->getParams();
        $entity = $this->service->persistData($params);
        return $this->serializeResult($entity);
    }

    // todo: реализовать валидацию на пустоту поля code
}
