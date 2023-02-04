<?php

namespace Untek\Bundle\Eav\Domain\Helpers;

use Untek\Bundle\Eav\Domain\Entities\EntityEntity;
use Untek\Bundle\Eav\Domain\Libs\TypeNormalizer;
use Untek\Bundle\Eav\Domain\Libs\Validator;
use Untek\Lib\Components\DynamicEntity\Interfaces\ValidateDynamicEntityInterface;

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