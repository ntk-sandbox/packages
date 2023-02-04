<?php

namespace Untek\Crypt\Jwt\Domain\Entities;

use Untek\Crypt\Jwt\Domain\Enums\JwtAlgorithmEnum;

/**
 * Class JwtHeaderEntity
 * @package Untek\Crypt\Base\Domain\Entities
 *
 * @property $typ string
 * @property $alg string
 * @property $kid string
 */
class JwtHeaderEntity
{

    public $typ = 'JWT';
    public $alg = JwtAlgorithmEnum::HS256;
    public $kid;

}
