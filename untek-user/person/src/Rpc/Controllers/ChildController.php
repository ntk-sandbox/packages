<?php

namespace Untek\User\Person\Rpc\Controllers;

use Untek\User\Person\Domain\Entities\PersonStrictEntity;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Validator\Helpers\ValidationHelper;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Model\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseCrudRpcController;
use Untek\Framework\Rpc\Presentation\Serializers\SerializerInterface;
use Untek\User\Person\Domain\Interfaces\Services\ChildServiceInterface;
use Untek\User\Person\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\User\Person\Rpc\Serializers\MyChildSerializer;

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
