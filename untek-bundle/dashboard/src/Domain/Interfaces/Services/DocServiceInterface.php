<?php

namespace Untek\Bundle\Dashboard\Domain\Interfaces\Services;

use Untek\Core\Contract\Common\Exceptions\NotFoundException;

interface DocServiceInterface
{

    /**
     * @param int $version
     * @return string
     * @throws NotFoundException
     */
    public function htmlByVersion(int $version): string;

    public function versionList(): array;

}

