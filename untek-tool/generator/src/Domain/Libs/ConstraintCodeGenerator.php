<?php

namespace Untek\Tool\Generator\Domain\Libs;

use Laminas\Code\Generator\FileGenerator;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Core\Text\Helpers\Inflector;
use Untek\Tool\Generator\Domain\Helpers\FieldRenderHelper;
use Untek\Tool\Generator\Domain\Helpers\TypeAttributeHelper;
use Untek\Tool\Generator\Domain\Libs\Types\ArrayType;
use Untek\Tool\Generator\Domain\Libs\Types\BaseType;
use Untek\Tool\Generator\Domain\Libs\Types\BoolType;
use Untek\Tool\Generator\Domain\Libs\Types\I18nType;
use Untek\Tool\Generator\Domain\Libs\Types\IntPositiveOrZeroType;
use Untek\Tool\Generator\Domain\Libs\Types\IntPositiveType;
use Untek\Tool\Generator\Domain\Libs\Types\IntType;
use Untek\Tool\Generator\Domain\Libs\Types\StatusIdType;

class ConstraintCodeGenerator
{

    private $fileGenerator;

    public function __construct(FileGenerator $fileGenerator)
    {
        $this->fileGenerator = $fileGenerator;
    }

    /*public function getTypes(string $attributeName) {
        $typeClasses = [
            IntType::class,
            IntPositiveType::class,
            IntPositiveOrZeroType::class,
            BoolType::class,
        ];
        $types = [];
        foreach ($typeClasses as $typeClass) {

        }
    }*/

    public function generateCode(string $attribute): array
    {
        $validationRules = [];
        $attributeName = Inflector::variablize($attribute);
//        $isInt = FieldRenderHelper::isMatchSuffix($attribute, '_id');

        if(IntPositiveType::match($attributeName)) {
            $validationRules[] = "\$metadata->addPropertyConstraint('$attributeName', new Assert\Positive());";
        }

        /*$isTime = FieldRenderHelper::isMatchSuffix($attribute, '_id');
        if($isTime) {
            $validationRules[] = "\$metadata->addPropertyConstraint('$attributeName', new Assert\DateTime());";
        }*/

//        $isStatus = $attribute == 'status_id';
        if(StatusIdType::match($attributeName)) {
            $this->fileGenerator->setUse(\Untek\Lib\Components\Status\Enums\StatusEnum::class);
            $this->fileGenerator->setUse(\Untek\Model\Components\Constraints\Enum::class);
            $validationRules[] =
                "\$metadata->addPropertyConstraint('$attributeName', new Enum([
    'class' => StatusEnum::class,
]));";
        }

        //$isBoolean = FieldRenderHelper::isMatchPrefix($attribute, 'is_');
        if(BoolType::match($attributeName)) {
            $this->fileGenerator->setUse(\Untek\Model\Validator\Constraints\Boolean::class);
            $validationRules[] = "\$metadata->addPropertyConstraint('$attributeName', new Boolean());";
        }

        //$isCount = FieldRenderHelper::isMatchSuffix($attribute, '_count') || $attribute == 'size';
        if(IntPositiveOrZeroType::match($attributeName)) {
            $validationRules[] = "\$metadata->addPropertyConstraint('$attributeName', new Assert\PositiveOrZero());";
        }

        if(ArrayType::match($attributeName) || I18nType::match($attributeName)) {
            $this->fileGenerator->setUse(\Untek\Model\Components\Constraints\Arr::class);
            $validationRules[] = "\$metadata->addPropertyConstraint('$attributeName', new Arr());";
        }

        return $validationRules;
    }
}

/*
id
user_id
title_i18n
name
group_name
group_title
description
like_count
store_size
is_accepted
has_child
props
group_props
status_id
created_at
updated_at
expired_at


 */