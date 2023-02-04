<?php

return [
    'singletons' => [
        'Untek\Crypt\Jwt\Domain\Interfaces\Services\JwtServiceInterface' => 'Untek\Crypt\Jwt\Domain\Services\JwtService',
        'Untek\Crypt\Jwt\Domain\Interfaces\Repositories\ProfileRepositoryInterface' => 'Untek\Crypt\Jwt\Domain\Repositories\Config\ProfileRepository',
    ],
];