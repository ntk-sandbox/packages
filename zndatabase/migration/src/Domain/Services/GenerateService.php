<?php

namespace ZnDatabase\Migration\Domain\Services;

use ZnDomain\Service\Base\BaseService;
use ZnDatabase\Migration\Domain\Interfaces\Repositories\GenerateRepositoryInterface;
use ZnDatabase\Migration\Domain\Interfaces\Services\GenerateServiceInterface;
use ZnDatabase\Migration\Domain\Scenarios\Render\CreateTableRender;
use ZnCore\Instance\Helpers\ClassHelper;

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

