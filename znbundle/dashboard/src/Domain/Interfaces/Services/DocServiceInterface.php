<?php

namespace ZnBundle\Dashboard\Domain\Interfaces\Services;

use ZnCore\Contract\Common\Exceptions\NotFoundException;

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

