<?php

namespace Untek\Crypt\Jwt\Domain\Interfaces\Services;

use Untek\Crypt\Jwt\Domain\Entities\JwtEntity;

interface JwtServiceInterface
{

    public function sign(JwtEntity $jwtEntity, string $profileName): string;
    public function verify(string $token, string $profileName): JwtEntity;
    public function decode(string $token);
    public function setProfiles($profiles);

}
