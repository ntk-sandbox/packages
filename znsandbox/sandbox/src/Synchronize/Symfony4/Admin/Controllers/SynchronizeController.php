<?php

namespace ZnSandbox\Sandbox\Synchronize\Symfony4\Admin\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ZnLib\Components\Http\Enums\HttpStatusCodeEnum;
use ZnLib\Web\Controller\Base\BaseWebController;
use ZnLib\Web\Controller\Interfaces\ControllerAccessInterface;
use ZnLib\Web\Form\Libs\FormManager;
use ZnLib\Web\Layout\Libs\LayoutManager;
use ZnSandbox\Sandbox\Synchronize\Domain\Interfaces\Services\SynchronizeServiceInterface;
use ZnUser\Rbac\Domain\Enums\Rbac\ExtraPermissionEnum;

class SynchronizeController extends BaseWebController implements ControllerAccessInterface
{

    protected $viewsDir = __DIR__ . '/../views/synchronize';
    protected $baseUri = '/synchronize';

    private $synchronizeService;

    public function __construct(
        FormManager $formManager,
        LayoutManager $layoutManager,
        SynchronizeServiceInterface $synchronizeService
    )
    {
        $this->setFormManager($formManager);
        $this->setLayoutManager($layoutManager);
        $this->synchronizeService = $synchronizeService;
        $title = 'Synchronize';
        // $this->getLayoutManager()->addBreadcrumb($title, $this->getBaseRoute() . '/index');
    }

    public function access(): array
    {
        return [
            'index' => [
                ExtraPermissionEnum::ADMIN_ONLY,
//                SynchronizeSynchronizePermissionEnum::ALL,
            ],
            'sync' => [
                ExtraPermissionEnum::ADMIN_ONLY,
//                SynchronizeSynchronizePermissionEnum::UPDATE,
            ],
        ];
    }

    public function index(Request $request): Response
    {
        $diffCollection = $this->synchronizeService->diff();
        return $this->render('index', [
            'diffCollection' => $diffCollection,
        ]);
    }

    public function sync(Request $request): Response
    {
        $this->synchronizeService->sync();
        $this->getLayoutManager()->getToastrService()->success(['synchronize', 'synchronize.message.sync_success']);
        $response = new RedirectResponse($this->getLayoutManager()->generateUrl('synchronize/synchronize/index'), HttpStatusCodeEnum::TEMPORARY_REDIRECT);
        return $response;
    }
}
