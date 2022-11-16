<?php

namespace ZnSandbox\Sandbox\Person\Domain\Services;

use ZnBundle\Eav\Domain\Entities\DynamicEntity;
use ZnBundle\Eav\Domain\Forms\DynamicForm;
use ZnBundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\ValueServiceInterface;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Text\Helpers\TextHelper;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Service\Base\BaseService;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnKaz\Iin\Domain\Helpers\IinParser;
use ZnSandbox\Sandbox\Person\Domain\Interfaces\Services\PersonServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Identity\Domain\Entities\IdentityEntity;
use ZnUser\Identity\Domain\Interfaces\Services\IdentityServiceInterface;

class PersonService extends BaseService implements PersonServiceInterface
{

    protected $identityService;
    protected $entityService;
    protected $valueService;
    protected $authService;

    public function __construct(
        EntityServiceInterface $entityService,
        ValueServiceInterface $valueService,
        AuthServiceInterface $authService,
        IdentityServiceInterface $identityService
    )
    {
        $this->entityService = $entityService;
        $this->valueService = $valueService;
        $this->authService = $authService;
        $this->identityService = $identityService;
    }

    protected function idFromName(string $entityName): int
    {
        $entityEntity = $this->entityService->findOneByName($entityName);
        return $entityEntity->getId();
    }

    public function findOneByAuth(string $entityName): DynamicEntity
    {
        $identityId = $this->authService->getIdentity()->getId();
        try {
            $entity = $this->findOneById($entityName, $identityId);
        } catch (NotFoundException $e) {
            $entity = $this->entityService->createEntityById($this->idFromName($entityName));
        }
        return $entity;
    }

    public function findOneById(string $entityName, int $id): DynamicEntity
    {
        return $this->valueService->oneRecord($this->idFromName($entityName), $id);
    }

    public function createForm(string $entityName, array $attributes = []): DynamicForm
    {
        $dynamicForm = $this->entityService->createFormById($this->idFromName($entityName));
        if ($attributes) {
            PropertyHelper::setAttributes($dynamicForm, $attributes);
        }
        return $dynamicForm;
    }

    public function updateMyData(string $entityName, DynamicForm $form): void
    {
        $identityId = $this->authService->getIdentity()->getId();
        $this->updateById($entityName, $form, $identityId);
    }

    public function updateById(string $entityName, DynamicForm $form, int $recordId): void
    {
        if ($entityName == 'person_info') {
            $this->validateBirthDate($form);
        }
        $dynamicEntity = $this->entityService->createEntityById($this->idFromName($entityName));
        PropertyHelper::setAttributes($dynamicEntity, $form->toArray());
        $dynamicEntity->setId($recordId);

        $this->entityService->validateEntity($dynamicEntity);

        if ($entityName == 'person_info') {
            $this->validateBirthDate($form);
        }

        $this->entityService->updateEntity($dynamicEntity);
        if ($entityName == 'person_info') {
            $this->updateIdentity($form, $recordId);
        }
    }

    private function updateIdentity(DynamicForm $form, int $recordId)
    {
        /** @var IdentityEntity $identityEntity */
        $identityEntity = $this->identityService->findOneById($recordId);
        $firstName = PropertyHelper::getValue($form, 'firstName');
        $lastName = PropertyHelper::getValue($form, 'lastName');
        $fullName = $firstName . ' ' . $lastName;
        $identityEntity->setUsername($fullName);
        $this->identityService->updateById($identityEntity->getId(), EntityHelper::toArray($identityEntity));
        // todo: обновить сессию
//        $this->getEntityManager()->persist($identityEntity);
    }

    private function validateBirthDate(DynamicForm $form)
    {
        $iinValue = PropertyHelper::getValue($form, 'iin');
        try {
            $iinEntity = IinParser::parse($iinValue);
        } catch (\Exception $e) {
            $exception = new UnprocessibleEntityException();
            $exception->add('iin', 'Bad iin');
            throw $exception;
        }
        $birthDay =
            $iinEntity->getBirthday()->getYear()
            . '-' .
            TextHelper::fill($iinEntity->getBirthday()->getMonth(), 2, '0', 'before')
            . '-' .
            TextHelper::fill($iinEntity->getBirthday()->getDay(), 2, '0', 'before');
        $birthDayValue = PropertyHelper::getValue($form, 'birthDate');
        if ($birthDay != $birthDayValue) {
            $exception = new UnprocessibleEntityException();
            $exception->add('birthDate', 'Birthday and IIN not equal');
            throw $exception;
        }
    }
}
