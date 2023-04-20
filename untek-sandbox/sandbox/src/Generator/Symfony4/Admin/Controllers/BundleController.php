<?php

namespace Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\TestBrowserToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;
use Untek\Component\Web\Controller\Base\BaseWebController;
use Untek\Component\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Component\Web\Form\Libs\FormManager;
use Untek\FrameworkPlugin\HttpLayout\Infrastructure\Libs\LayoutManager;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Services\BundleServiceInterface;
use Untek\Sandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;
use Untek\Database\Base\Domain\Repositories\Eloquent\SchemaRepository;
use Untek\Framework\Rpc\Domain\Model\MethodEntity;
use Untek\Framework\Rpc\Domain\Interfaces\Services\MethodServiceInterface;
use Untek\Sandbox\Sandbox\Generator\Domain\Entities\FavoriteEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Helpers\FavoriteHelper;
use Untek\Sandbox\Sandbox\Generator\Domain\Interfaces\Services\ClientServiceInterface;
use Untek\Sandbox\Sandbox\Generator\Domain\Interfaces\Services\FavoriteServiceInterface;
use Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Forms\ImportForm;
use Untek\Sandbox\Sandbox\Generator\Symfony4\Admin\Forms\RequestForm;
use Untek\User\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;

class BundleController extends BaseWebController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/bundle';
    protected $baseUri = '/generator/bundle';
    protected $formClass = RequestForm::class;
    private $clientService;
    private $favoriteService;
    private $methodService;
    private $layoutManager;
    private $bundleService;
    private $schemaRepository;

    public function __construct(
        FormManager $formManager,
        LayoutManager $layoutManager,
        UrlGeneratorInterface $urlGenerator,
        SchemaRepository $schemaRepository,
        BundleServiceInterface $bundleService
    )
    {
        $this->setFormManager($formManager);
        $this->setLayoutManager($layoutManager);
        $this->setUrlGenerator($urlGenerator);
        $this->setBaseRoute('generator/bundle');

        $this->bundleService = $bundleService;
        $this->schemaRepository = $schemaRepository;

        $this->getLayoutManager()->addBreadcrumb('Generator', 'generator/bundle');
    }

    /*public function with(): array
    {
        return [
            'application',
        ];
    }*/

    public function access(): array
    {
        return [
            'index' => [
                ExtraPermissionEnum::ADMIN_ONLY,
            ],
            'view' => [
                ExtraPermissionEnum::ADMIN_ONLY,
            ],
        ];
    }

    public function index(Request $request): Response
    {
        $bundleCollection = $this->bundleService->findAll();
        //dd($bundleCollection);
        return $this->render('index', [
            'bundleCollection' => $bundleCollection,
        ]);
    }

    public function view(Request $request): Response
    {
        $id = $request->query->get('id');
        $bundleEntity = $this->bundleService->findOneById($id);
//dd($bundleEntity);

        if($bundleEntity->getDomain()) {

        }
        $tableCollection = $this->schemaRepository->allTables();
        $tableList = CollectionHelper::getColumn($tableCollection, 'name');
        $entityNames = [];
        foreach ($tableList as $tableName) {
            $bundleName = TableMapperHelper::extractDomainNameFromTable($tableName);
            if ($bundleEntity->getDomain()->getName() == $bundleName) {
                $entityNames[] = TableMapperHelper::extractEntityNameFromTable($tableName);
            }
        }
        dd($entityNames);

    }
}
