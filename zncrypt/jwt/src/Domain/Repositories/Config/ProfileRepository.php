<?php

namespace Untek\Crypt\Jwt\Domain\Repositories\Config;

use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Core\DotEnv\Domain\Libs\DotEnvMap;
use Untek\Crypt\Jwt\Domain\Entities\JwtProfileEntity;
use Untek\Crypt\Jwt\Domain\Entities\KeyEntity;
use Untek\Crypt\Jwt\Domain\Interfaces\Repositories\ProfileRepositoryInterface;
use Untek\Lib\Components\Time\Enums\TimeEnum;

class ProfileRepository implements ProfileRepositoryInterface
{

    public function findOneByName(string $profileName)
    {
        $prifile = DotEnvMap::get('jwt.profiles.' . $profileName);
        $keyEntity = new KeyEntity;
        PropertyHelper::setAttributes($keyEntity, $prifile['key']);
        $profileEntity = new JwtProfileEntity;
        $profileEntity->name = $profileName;
        $profileEntity->key = $keyEntity;
        $profileEntity->life_time = $prifile['life_time'] ?? TimeEnum::SECOND_PER_YEAR;
        return $profileEntity;
    }

}