<?php

namespace Untek\Bundle\Eav\Tests\Unit;

use Untek\Bundle\Eav\Domain\Services\EntityService;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Tool\Test\Base\BaseRestApiTest;

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
