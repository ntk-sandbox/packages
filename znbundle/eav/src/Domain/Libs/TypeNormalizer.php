<?php

namespace ZnBundle\Eav\Domain\Libs;

use ZnBundle\Eav\Domain\Entities\EntityEntity;

class TypeNormalizer
{

    public function normalizeData(array $data, EntityEntity $entityEntity)
    {
        foreach ($entityEntity->getAttributes() as $attributeEntity) {
            $attributeName = $attributeEntity->getName();
            $default = $attributeEntity->getDefault();
            $type = $attributeEntity->getType();
            $value = $data[$attributeName] ?? null;
            if ($default !== null && $value === null) {
                $value = $default;
            }
            $value = $this->typeCast($value, $type);
            $data[$attributeName] = $value;
        }
        return $data;
    }

    private function typeCast($value, string $type)
    {
        if ($value !== null) {
            if ($type == 'boolean' || $type == 'bool') {
                $value = boolval($value);
            } elseif ($type == 'int' || $type == 'integer') {
                $value = intval($value);
            }
        }
        return $value;
    }
}
