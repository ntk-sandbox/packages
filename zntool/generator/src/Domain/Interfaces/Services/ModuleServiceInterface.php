<?php

namespace Untek\Tool\Generator\Domain\Interfaces\Services;

use Untek\Tool\Generator\Domain\Dto\BuildDto;

interface ModuleServiceInterface
{

    public function generate(BuildDto $buildDto);

}
