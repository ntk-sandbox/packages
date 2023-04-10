<?php

namespace Untek\User\Rbac\Symfony4\Admin\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Untek\Component\Web\Controller\Base\BaseWebController;
use Untek\Component\Web\Controller\Interfaces\ControllerAccessInterface;
use Untek\Component\Web\Form\Libs\FormManager;
use Untek\Component\Web\Layout\Libs\LayoutManager;
use Untek\User\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;
use Untek\User\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;
use Untek\User\Rbac\Domain\Interfaces\Services\RoleServiceInterface;

class InfoController extends BaseWebController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/info';
    protected $baseUri = '/rbac/info';

    public function __construct(
        FormManager $formManager,
        LayoutManager $layoutManager,
        UrlGeneratorInterface $urlGenerator,
        RoleServiceInterface $roleService,
        ManagerServiceInterface $managerService
//        SchemaRepository $schemaRepository,
//        BundleServiceInterface $bundleService
    )
    {
        //dd($roleService->findAll());
        //dd($managerService->allNestedItemsByRoleName(SystemRoleEnum::ADMINISTRATOR));
        $this->setFormManager($formManager);
        $this->setLayoutManager($layoutManager);
        $this->setUrlGenerator($urlGenerator);
        $this->setBaseRoute('rbac/info');

//        $this->bundleService = $bundleService;
//        $this->schemaRepository = $schemaRepository;

        $this->getLayoutManager()->addBreadcrumb('Generator', 'generator/bundle');
    }

    /*public function __construct(
        ToastrServiceInterface $toastrService,
        FormFactoryInterface $formFactory,
        CsrfTokenManagerInterface $tokenManager,
        BreadcrumbWidget $breadcrumbWidget
    )
    {
//        $this->setService($service);
        //$this->setToastrService($toastrService);
        //$this->setFormFactory($formFactory);
        //$this->setTokenManager($tokenManager);
        //$this->setBreadcrumbWidget($breadcrumbWidget);

//        $title = 'RBAC info';
//        $this->getBreadcrumbWidget()->add($title, Url::to([$this->getBaseUri()]));
    }*/

    public function access(): array
    {
        return [
            'index' => [
                ExtraPermissionEnum::ADMIN_ONLY,
//                DashboardPermissionEnum::ALL
            ],
        ];
    }

    public function index(Request $request): Response
    {
        return $this->render('index');

        return new Response('sadasda');
        dd(34);
    }
}
