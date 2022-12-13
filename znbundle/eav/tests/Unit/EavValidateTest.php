<?php

namespace ZnBundle\Eav\Tests\Unit;

use ZnBundle\Eav\Domain\Services\EntityService;
use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\Collection\Helpers\CollectionHelper;
use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnTool\Test\Base\BaseRestApiTest;

include __DIR__ . '/../bootstrap.php';

class EavValidateTest extends BaseRestApiTest
{

    protected $basePath = 'v1';

    protected function fixtures(): array
    {
        return [
            'eav_category',
            'eav_entity',
            'eav_entity_attribute',
            'eav_enum',
            'eav_attribute',
            'eav_validation',
            'eav_measure',
            'user_credential',
            'auth_assignment',
        ];
    }

    public function testValidateEntity()
    {
        $body = [
            'season' => 'summer',
            'volume' => '6',
        ];
        $entityService = $this->getService();
        $entity = $entityService->validate(1, $body);
        $this->assertEquals($body, EntityHelper::toArray($entity));
    }

    public function testValidateEntityNegative()
    {
        $body = [
            'season' => 'summer111',
            'volume' => '6',
        ];
        $entityService = $this->getService();
        try {
            $entityService->validate(1, $body);
        } catch (UnprocessibleEntityException $e) {
            $expect = [
                [
                    "field" => "season",
                    "message" => "Выбранное Вами значение недопустимо.",
                ],
            ];
            $this->assertArraySubset($expect, CollectionHelper::toArray($e->getErrorCollection()));
        }
    }

    private function getService(): EntityService
    {
        $container = ContainerHelper::getContainer();
        /** @var EntityService $entityService */
        $entityService = $container->get(EntityService::class);
        return $entityService;
    }
}
