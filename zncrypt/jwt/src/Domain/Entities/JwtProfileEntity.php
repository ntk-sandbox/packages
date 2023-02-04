<?php

namespace Untek\Crypt\Jwt\Domain\Entities;

use Untek\Lib\Components\Time\Enums\TimeEnum;
use Untek\Crypt\Base\Domain\Enums\EncryptAlgorithmEnum;
use Untek\Crypt\Base\Domain\Enums\EncryptFunctionEnum;
use Untek\Crypt\Jwt\Domain\Enums\JwtAlgorithmEnum;

/**
 * Class JwtProfileEntity
 * @package Untek\Crypt\Base\Domain\Entities
 *
 * @property $name string
 * @property $life_time integer
 * @property $allowed_algs string[]
 * @property $default_alg string
 * @property $hash_alg string
 * @property $func string
 * @property $audience string[]
 * @property $issuer_url string
 */
class JwtProfileEntity extends ProfileEntity
{

    public $name;
    public $life_time = TimeEnum::SECOND_PER_MINUTE * 20;
    // protected $allowed_algs = ['HS256', 'SHA512', 'HS384', 'RS256'];
    public $allowed_algs = [
        JwtAlgorithmEnum::HS256,
        JwtAlgorithmEnum::HS512,
        JwtAlgorithmEnum::HS384,
        JwtAlgorithmEnum::RS256,
    ];
    public $default_alg = JwtAlgorithmEnum::HS256;
    public $hash_alg = EncryptAlgorithmEnum::SHA256;
    public $func = EncryptFunctionEnum::HASH_HMAC;
    public $audience = [];
    public $issuer_url;

}
