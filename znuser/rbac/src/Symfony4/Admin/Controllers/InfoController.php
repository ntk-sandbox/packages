<?php

namespace ZnUser\Rbac\Symfony4\Admin\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use ZnLib\Web\Controller\Base\BaseWebController;
use ZnLib\Web\Controller\Interfaces\ControllerAccessInterface;
use ZnLib\Web\Form\Libs\FormManager;
use ZnLib\Web\Layout\Libs\LayoutManager;
use ZnUser\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\RoleServiceInterface;

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
