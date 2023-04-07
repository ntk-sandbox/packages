<?php

namespace Untek\Sandbox\Sandbox\Person2\Rpc\Controllers;

use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Validator\Helpers\ValidationHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\Framework\Rpc\Rpc\Serializers\SerializerInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\ChildServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Rpc\Serializers\MyChildSerializer;

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
