<?php

namespace Untek\User\Person\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Untek\Bundle\Reference\Domain\Constraints\ReferenceItem;
use Untek\Domain\Components\Constraints\Enum;
use Untek\Core\Text\Helpers\TextHelper;
use Untek\Domain\Validator\Interfaces\ValidationByMetadataInterface;
use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Lib\Components\Status\Enums\StatusEnum;
use Untek\User\Rbac\Domain\Entities\ItemEntity;

class PersonEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    protected $id = null;

    protected $code = null;

//    protected $identityId = null;

    protected $firstName = null;

    protected $middleName = null;

    protected $lastName = null;

    protected $birthday = null;

    protected $sexId = null;

    protected $statusId = StatusEnum::ENABLED;

//    protected $attributes = [];

    protected $contacts = null;

    protected $sex = null;

    protected $identity = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
//        $metadata->addPropertyConstraint('code', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('identityId', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('identityId', new Assert\Positive());
        $metadata->addPropertyConstraint('firstName', new Assert\NotBlank);
        $metadata->addPropertyConstraint('birthday', new Assert\DateTime([
            'format' => 'd.m.Y',
        ]));
//        $metadata->addPropertyConstraint('middleName', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('lastName', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('birthday', new Assert\NotBlank);
//        $metadata->addPropertyConstraint('sexId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('sexId', new Assert\Positive());
        $metadata->addPropertyConstraint('sexId', new ReferenceItem([
            'bookName' => 'sex',
        ]));

        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
//        $metadata->addPropertyConstraint('attributes', new Assert\NotBlank);
    }

    public function unique(): array
    {
        return [
            ['code']
        ];
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCode($value): void
    {
        $this->code = $value;
    }

    public function getCode()
    {
        if($this->code) {
            return trim($this->code) ? $this->code : null;
        }
        return null;
    }

    /*public function setIdentityId($value) : void
    {
        $this->identityId = $value;
    }

    public function getIdentityId()
    {
        return $this->identityId;
    }*/

    public function setFirstName($value): void
    {
        $this->firstName = $value;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setMiddleName($value): void
    {
        $this->middleName = $value;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function setLastName($value): void
    {
        $this->lastName = $value;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getTitle(): string
    {
        $parentFio =
            $this->getLastName() . ' ' .
            $this->getFirstName() . ' ' .
            $this->getMiddleName();
        $parentFio = TextHelper::removeDoubleSpace($parentFio);
        $parentFio = trim($parentFio);
        return $parentFio;
    }

    public function setBirthday($value): void
    {
        if ($value) {
            $date = new \DateTime($value);
            $this->birthday = $date->format('d.m.Y');
        }
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setSexId($value): void
    {
        $this->sexId = $value;
    }

    public function getSexId()
    {
        return $this->sexId;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }

    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    /*public function setAttributes($value) : void
    {
        $this->attributes = $value;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    protected function setAttribute($value, $name) : void
    {
        ArrayHelper::setValue($this->attributes, $name, $value);
    }

    protected function getAttribute($name)
    {
        return ArrayHelper::getValue($this->attributes, $name);
    }*/

    public function getContacts(): ?Enumerable
    {
        return $this->contacts;
    }

    public function setContacts(?Enumerable $contacts): void
    {
        $this->contacts = $contacts;
    }

    public function getSex(): ?ItemEntity
    {
        return $this->sex;
    }

    public function setSex(?ItemEntity $sex): void
    {
        $this->sex = $sex;
    }

    public function getIdentity(): ?IdentityEntityInterface
    {
        return $this->identity;
    }

    public function setIdentity(?IdentityEntityInterface $identity): void
    {
        $this->identity = $identity;
    }
}
