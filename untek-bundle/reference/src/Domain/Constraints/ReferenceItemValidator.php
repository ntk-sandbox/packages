<?php

namespace Untek\Bundle\Reference\Domain\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Untek\Bundle\Reference\Domain\Entities\ItemEntity;
use Untek\Bundle\Reference\Domain\Interfaces\Repositories\ItemRepositoryInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Query\Entities\Query;
use Untek\Kaz\Iin\Domain\Helpers\IinParser;
use Exception;

class ReferenceItemValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ReferenceItem) {
            throw new UnexpectedTypeException($constraint, ReferenceItem::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_numeric($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'numeric');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        try {
            /** @var ItemRepositoryInterface $itemRepository */
            $itemRepository = ContainerHelper::getContainer()->get(ItemRepositoryInterface::class);
            $query = new Query();
            $query->with('book');
            /** @var ItemEntity $itemEntity */
            $itemEntity = $itemRepository->findOneById($value, $query);
            if($itemEntity->getBook()->getEntity() != $constraint->bookName) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value)
                    ->setParameter('{{ bookName }}', $constraint->bookName)
                    ->addViolation();
            }
            /*dd($itemEntity);
            $iinEntity = IinParser::parse($value);*/
        } catch (NotFoundException $e) {
            $this->context->buildViolation($constraint->notFoundMessage)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        } catch (Exception $e) {
            if($constraint->message) {
                $message = $constraint->message;
            } else {
                $message = $e->getMessage();
            }
            $this->context->buildViolation($message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
