<?php

namespace ZnBundle\Eav\Domain\Helpers;

use ZnBundle\Eav\Domain\Entities\EntityEntity;
use ZnBundle\Eav\Domain\Libs\TypeNormalizer;
use ZnBundle\Eav\Domain\Libs\Validator;
use ZnLib\Components\DynamicEntity\Interfaces\ValidateDynamicEntityInterface;

class EavEntityValidationHelper
{

    public static function validate(ValidateDynamicEntityInterface $dynamicEntity, EntityEntity $entityEntity, array $data): void
    {
        $normalizer = new TypeNormalizer();
        $data = $normalizer->normalizeData($data, $entityEntity);
        EntityHelper::setAttributes($dynamicEntity, $data);
        $validator = new Validator();
        $validator->validate($data, $dynamicEntity->validationRules());
    }
}