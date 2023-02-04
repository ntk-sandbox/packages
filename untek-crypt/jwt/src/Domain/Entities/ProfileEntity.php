<?php

namespace Untek\Crypt\Jwt\Domain\Entities;

use Untek\Crypt\Base\Domain\Enums\EncryptAlgorithmEnum;

/**
 * Class ConfigEntity
 * @package Untek\Crypt\Base\Domain\Entities
 *
 * @property KeyEntity $key
 * @property string $algorithm
 */
class ProfileEntity
{

    public $key;
    public $algorithm = EncryptAlgorithmEnum::SHA256;


    /*public function fieldType()
    {
        return [
            'key' => KeyEntity::class,
        ];
    }*/
}
