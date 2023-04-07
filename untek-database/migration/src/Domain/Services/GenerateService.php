<?php

namespace Untek\Database\Migration\Domain\Services;

use Untek\Model\Service\Base\BaseService;
use Untek\Database\Migration\Domain\Interfaces\Repositories\GenerateRepositoryInterface;
use Untek\Database\Migration\Domain\Interfaces\Services\GenerateServiceInterface;
use Untek\Database\Migration\Domain\Scenarios\Render\CreateTableRender;
use Untek\Core\Instance\Helpers\ClassHelper;

class GenerateService extends BaseService implements GenerateServiceInterface
{

    public function __construct(GenerateRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function generate(object $dto)
    {


        //if($dto->type == GenerateActionEnum::CREATE_TABLE) {
        $class = CreateTableRender::class;
        //}

        //dd($dto);
        $dto->attributes = [];

        $dto->attributes = [];

        $scenarioInstance = new $class;
        $scenarioParams = [
            'dto' => $dto,
        ];
        ClassHelper::configure($scenarioInstance, $scenarioParams);
        //$scenarioInstance->init();
        $scenarioInstance->run();

        //dd($dto);
    }

}

