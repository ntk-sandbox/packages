<?php

namespace Untek\User\Person\Rpc\Controllers;

use Symfony\Component\Validator\Constraints\NotBlank;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Validator\Helpers\ValidationHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseCrudRpcController;
use Untek\User\Person\Domain\Interfaces\Services\PersonServiceInterface;

class PersonController extends BaseCrudRpcController
{

    public function __construct(PersonServiceInterface $personService)
    {
        $this->service = $personService;
    }

    public function persist(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $params = $requestEntity->getParams();

        $errors = ValidationHelper::validateValue(ArrayHelper::getValue($params, 'code'), [new NotBlank()]);
        if ($errors->count()) {
            $e = new UnprocessibleEntityException();
            foreach ($errors as $errorEntity) {
                $e->add('code', $errorEntity->getMessage());
            }
            throw $e;
        }

        $entity = $this->service->createEntity($params);
        $this->service->persist($entity);
        return $this->serializeResult($entity);
    }
}
