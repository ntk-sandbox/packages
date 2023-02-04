<?php

namespace Untek\Lib\Init\Symfony4\Web\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Database\Fixture\Domain\Services\FixtureService;
use Untek\Lib\Init\Domain\Services\LockerService;
use Untek\Lib\Init\Domain\Services\RequirementService;
use Untek\Database\Migration\Domain\Entities\MigrationEntity;
use Untek\Database\Migration\Domain\Services\MigrationService;
use Untek\Lib\Rest\Web\Controller\BaseCrudWebController;
use Untek\Lib\Web\Controller\Base\BaseWebController;

class InitController extends BaseWebController
{

    protected $viewsDir = __DIR__ . '/../views/init';

    private $fixtureService;
    private $migrationService;
    private $lockerService;
    private $requirementService;

    public function __construct(
        MigrationService $migrationService,
        FixtureService $fixtureService,
        LockerService $lockerService,
        RequirementService $requirementService
    )
    {
        $this->fixtureService = $fixtureService;
        $this->migrationService = $migrationService;
        $this->lockerService = $lockerService;
        $this->requirementService = $requirementService;
        $this->lockerService->checkLocker();
    }

    public function index(Request $request): Response
    {
        $result = $this->requirementService->checkRequirements();
        return $this->renderTemplate('index', $result);
    }

    public function env(Request $request): Response
    {
        return $this->renderTemplate('env', []);
    }

    public function install(Request $request): Response
    {
        $initResult = $this->initApp();
        $migrationNames = $this->upMigrations();
        $fixtureNames = $this->importFixtures();
        $this->lockerService->lock();

        return $this->renderTemplate('install', [
            'initResult' => $initResult,
            'migrationNames' => $migrationNames,
            'fixtureNames' => $fixtureNames,
        ]);
    }

    private function initApp()
    {
        $initResult = shell_exec('cd ../.. && php init --env=Development --overwrite=All');
        return $initResult;
    }

    private function importFixtures(): array
    {
        $all = $this->fixtureService->allTables();
        $fixtureNames = [];
        if ($all->count()) {
            $fixtureNames = CollectionHelper::getColumn($all, 'name');
            $this->fixtureService->importAll($fixtureNames);
        }
        return $fixtureNames;
    }

    private function upMigrations(): array
    {
        /** @var MigrationEntity[] $migrationCollection */
        $migrationCollection = $this->migrationService->allForUp();
        $migrationNames = [];
        if ($migrationCollection) {
            foreach ($migrationCollection as $migrationEntity) {
                $this->migrationService->upMigration($migrationEntity);
                $migrationNames[] = $migrationEntity->className;
            }
        }
        return $migrationNames;
    }
}
